<?php
	if( !defined("APP") )
	{
		exit("ERROR");
	}
?>
<?php
	$pid = (string)filter_input(INPUT_GET, "pid", FILTER_VALIDATE_INT);
	$page = (string)filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
	if($pid!=="" && $page!=="")
	{
		$parentEntity = getEntity($pid);
		if($parentEntity!==false)
		{
			if( USER_TYPE==="AUTHOR" && $parentEntity["entity_role"] && !in_array($parentEntity["entity_role"], getUserRoles($_SESSION["user"])) )
			{
				?><meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["SCRIPT_NAME"]."?sections&pid=0" ?>"><?php
			}
			else
			{
				define("SECTION_LINK", $_SERVER["SCRIPT_NAME"]."?widgets&pid=".$pid."&page=".$page);
				
				if( isset($_POST["orders"]) && is_array($_POST["orders"]) )
				{
					$_POST["orders"] = array_reverse($_POST["orders"]);
					
					foreach($_POST["orders"] as $key=>$val)
					{
						$key = (int)$key;
						
						$val = (int)$val;
						
						$db->request("UPDATE entities SET entity_order=? WHERE entity_id=?", array($key, $val));
					}
					
					exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
				}
				else
				{
					?>

					<div class="position-relative top-pad">
						<div class="top-section-funktional">
							<?php
								if($pid!=="0")
								{
									$parentEntity = getEntity($pid);
									if($parentEntity!==false)
									{
										?>
										<div style="width: 170%;">
											<a class="south-east btn blue" href="<?php echo $_SERVER["SCRIPT_NAME"]."?sections&pid=".$parentEntity["entity_parent"]."&page=".$page ?>">Back <img src="img/back.png" alt=""></a>
										</div>
										<?php
									}
								}
							?>
							
							<div class="search-and-add">
								<div class="search-wrap">
									<input type="text" name="keyword" class="keyword" value="" placeholder="search..">
								</div>
								<a class="btn green" href="<?php echo $_SERVER["SCRIPT_NAME"]."?addWidget&pid=".$pid."&page=".$page ?>">Add new section  <img src="img/plus-square.svg" alt=""></a>
							</div>
						</div>

                        <div class="oneMoreEntity">
                            <div class="breadCrumb">
                                <?php
                                if($pid!=="0")
                                {
                                    $treeItems = array();

                                    $iterPid = $pid;

                                    while($iterPid!==0)
                                    {
                                        $iterEntity = getEntity($iterPid);
                                        if($iterEntity!==false)
                                        {
                                            if($iterEntity[TITLE_FIELD])
                                            {
                                                $treeItems[] = $iterEntity[TITLE_FIELD];
                                            }
                                            else
                                            {
                                                $treeItems[] = $iterEntity["entity_creation_date"];
                                            }

                                            $iterPid = $iterEntity["entity_parent"];
                                        }
                                        else
                                        {
                                            $iterPid = 0;
                                        }
                                    }

                                    if(count($treeItems) > 0)
                                    {
                                        $treeItems = array_reverse($treeItems);

                                        $breadcrumb_title = array_pop($treeItems);

                                        echo implode(" > ", $treeItems);
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            if(isset($breadcrumb_title)) {
                                ?>
                                <div class="breadcrumb_title">
                                    <?php echo $breadcrumb_title ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

						<section id="welcome" class="tm-section">
							<form action="<?php echo SECTION_LINK ?>" method="post" class="contact-form white-background-color form-pading" name="orderForm">
								<table border="1" cellpadding="10" cellspacing="0" class="report" id="report">
									<thead>
										<tr>
											<th class="pickColumn"></th>
											<th>ID</th>
											<th>Type</th>
											<?php
												foreach($additionalColumnsInWidgets as $key=>$value)
												{
													?>
														<th><?php echo $value ?></th>
													<?php
												}
											?>
											<th>Created</th>
											<th>Visibility</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$where = "";
											
											if(USER_TYPE==="AUTHOR")
											{
												$userRoles = getUserRoles($_SESSION["user"]);
												if( count($userRoles) > 0 )
												{
													$where .= " AND (entity_role IN (".implode(",", $userRoles).") OR entity_role IS NULL)";
												}
												else
												{
													$where .= " AND entity_role IS NULL";
												}
											}
											
											$query = "SELECT * FROM entities
												LEFT JOIN entity_data ON ed_entity=entity_id
												LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
												LEFT JOIN users ON user_id=entity_creator
												WHERE entity_parent=? AND entity_is_widget=1 ".$where." ORDER BY entity_order DESC";
											
											$results = $db->data($query, array($pid));
											foreach($results as $result)
											{
												$entityId = $result["entity_id"];
												?>
													<tr id="<?php echo $entityId ?>">
														<td class="pickColumn"><input class="pickBox" type="checkbox" onclick="innerPick(this)"/></td>
														<td class="idColumn"><?php echo $result["entity_id"] ?></td>
														<td class="typeColumn">
															<?php
																$template = searchTemplate($result["entity_type"]);
																if($template!==false)
																{
																	echo $template["title"];
																}
																else
																{
																	echo $result["entity_type"];
																}
															?>
														</td>
														<?php
															foreach($additionalColumnsInWidgets as $key=>$value)
															{
																?>
																	<td class="titleColumn"><?php echo $result[$key] ?></td>
																<?php
															}
														?>
														<td><?php echo $result["entity_creation_date"] ?></td>
														<td>
															<input type="hidden" name="orders[]" value="<?php echo $entityId ?>">
															<?php
																if($result["entity_visible"]===0)
																{
																	echo "<i>Hidden</i>";
																}
																elseif($result["entity_visible"]===1)
																{
																	echo "Visible";
																}
															?>
														</td>
														<td><a href="<?php echo $_SERVER["SCRIPT_NAME"]."?editWidget&eid=".$entityId."&page=".$page ?>" class="linkButton btn blue">EDIT <img src="img/x-square.png" alt=""></a></td>
													</tr>
												<?php
											}
										?>
									</tbody>
								</table>
							</form>
						</section>
					<?php
				}
			}
		}
		else
		{
			?><meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["SCRIPT_NAME"]."?sections&pid=0" ?>"><?php
		}
	}
	else
	{
		?><meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["SCRIPT_NAME"]."?sections&pid=0" ?>"><?php
	}
?>
