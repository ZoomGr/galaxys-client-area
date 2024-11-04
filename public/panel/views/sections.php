<?php
	if( !defined("APP") )
	{
		exit("ERROR");
	}
?>
<?php
	$pid = (string)filter_input(INPUT_GET, "pid", FILTER_VALIDATE_INT);
	if($pid!=="")
	{
		$parentEntity = false;
		if($pid!=="0")
		{
			$parentEntity = getEntity($pid);
			if($parentEntity!==false && USER_TYPE==="AUTHOR" && $parentEntity["entity_role"])
			{
				if( !in_array($parentEntity["entity_role"], getUserRoles($_SESSION["user"])) )
				{
					exit("<meta http-equiv='refresh' content='0; url=".$_SERVER["SCRIPT_NAME"]."'>");
				}
			}
		}

		if($pid==="0" || $parentEntity!==false)
		{
			define("SECTION_LINK", $_SERVER["SCRIPT_NAME"]."?sections&pid=".$pid);

			if( isset($_POST["keyword"]) && is_string($_POST["keyword"]) && trim($_POST["keyword"])!=="" )
			{
				exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."&keyword=".htmlspecialchars(trim($_POST["keyword"]), ENT_QUOTES)."'>");
			}
			elseif( isset($_POST["orders"]) && is_array($_POST["orders"]) )
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
				$where = "";

				$data = array($pid);

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

				if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" )
				{
					$where .= " AND ".TITLE_FIELD." LIKE ?";

					$data[] = "%".$_GET["keyword"]."%";
				}

				$query = "SELECT COUNT(*) AS mCnt FROM entities
					LEFT JOIN entity_data ON ed_entity=entity_id
					LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
					LEFT JOIN users ON user_id=entity_creator
					WHERE entity_parent=? AND entity_is_widget=0 ".$where;

				$results = $db->data($query, $data);
				if( count($results) > 0 )
				{
					$page = 1;
					if( isset($_GET["page"]) && is_string($_GET["page"]) && ctype_digit($_GET["page"]) )
					{
						$page = abs( (int)$_GET["page"] );

						if($page < 1)
						{
							$page = 1;
						}
					}

					$offset = ($page - 1) * PAGE_SIZE;

					$pages = ceil($results[0]["mCnt"] / PAGE_SIZE);
					if($pages > 1)
					{
						if( isset($custormSortFields[$pid]) )
						{
							$orderBy = $custormSortFields[$pid];
						}
						else
						{
							$orderBy = "entity_creation_date DESC";
						}

						$target = "_self";

						$tableId = "";//no drag and drop
					}
					else
					{
						if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" )
						{
							$orderBy = "entity_creation_date DESC";

							$target = "_blank";

							$tableId = "";//no drag and drop
						}
						else
						{
							$orderBy = "entity_order DESC";

							$target = "_self";

							$tableId = "report";//drag and drop
						}
					}

					$query = "SELECT * FROM entities
						LEFT JOIN entity_data ON ed_entity=entity_id
						LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
						LEFT JOIN users ON user_id=entity_creator
						WHERE entity_parent=? AND entity_is_widget=0 ".$where." ORDER BY ".$orderBy." LIMIT ?, ?";

					$data[] = $offset;
					$data[] = PAGE_SIZE;
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
												<a class="south-east btn blue" href="<?php echo $_SERVER["SCRIPT_NAME"]."?sections&pid=".$parentEntity["entity_parent"] ?>">Back <img src="img/back.png" alt=""></a>
											</div>
										<?php
									}
								}
							?>
							<div class="search-and-add">
								<div class="search-wrap">
									<form action="<?php echo SECTION_LINK ?>" method="get">
										<?php
											$keyword = "";

											if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" )
											{
												$keyword = trim($_GET["keyword"]);
											}
										?>
										<input type="text" name="keyword" class="keyword" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES) ?>" placeholder="search..">
									</form>
								</div>
								<?php
									if( !isset($disableAddButtonIn) || !in_array($pid, $disableAddButtonIn)  )
									{
										?>
											<a class="btn green" href="<?php echo $_SERVER["SCRIPT_NAME"]."?addSection&pid=".$pid."&page=".$page ?>">Add new section  <img src="img/plus-square.svg" alt=""></a>
										<?php
									}
								?>
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
                                            elseif (!empty($iterEntity['ed_title']))
                                            {
                                                $treeItems[] = $iterEntity['ed_title'];
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
									<table border="1" cellpadding="10" cellspacing="0" class="report" id="<?php echo $tableId ?>">
										<thead>
											<tr>
												<th class="pickColumn"></th>
												<th></th>
												<th>ID</th>
												<th>Title</th>
												<?php
													if( isset($additionalColumnsInSections[$pid]) )
													{
														foreach($additionalColumnsInSections[$pid] as $key=>$value)
														{
															?>
																<th><?php echo $value ?></th>
															<?php
														}
													}
												?>
												<th>Subsections</th>
												<th>Created</th>
												<?php
//                                                var_dump(in_array($parentEntity["entity_type"], $widgetWhiteList, true)); die();
													if(isset($widgetWhiteList))
													{
														if(in_array($pid, $widgetWhiteList) || ($parentEntity!==false && in_array($parentEntity["entity_type"], $widgetWhiteList, true)))
														{
															?>
																<th>Widgets</th>
															<?php
														}
													}
												?>
												<th>Visibility</th>
												<th>Type</th>
												<th>Order</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
												$results = $db->data($query, $data);
												foreach($results as $result)
												{
													$entityId = $result["entity_id"];

													$template = searchTemplate($result["entity_type"]);

													$bgStyle = "";

													if( $result[IMG_FIELD] && is_file($result[IMG_FIELD]) )
													{
														$bgStyle = "background-image:url('".$result[IMG_FIELD]."')";
													}
													?>
														<tr id="<?php echo $entityId ?>">
															<td class="pickColumn"><input class="pickBox" type="checkbox" onclick="innerPick(this)"/></td>
															<td class="imageColumn" style="<?php echo $bgStyle ?>"><div>&nbsp;</div></td>
															<td class="idColumn"><?php echo $result["entity_id"] ?></td>
                                                            <?php
                                                            if (in_array($result['entity_type'], ['chat_user', 'chat', 'chat_message'])) {
                                                            ?>
															<td class="titleColumn"><?php echo $result['ed_title'] ?? substr($result['ed_text_1'],0,250)."..." ?></td>
                                                            <?php } else { ?>
                                                                <td class="titleColumn"><?php echo $result[TITLE_FIELD] ?></td>
                                                                <?php
                                                            }
                                                            ?>
															<?php
																if( isset($additionalColumnsInSections[$pid]) )
																{
																	foreach($additionalColumnsInSections[$pid] as $key=>$value)
																	{
																		?>
																			<td class="titleColumn"><?php echo $result[$key] ?></td>
																		<?php
																	}
																}
															?>
															<td>
																<a href="<?php echo $_SERVER["SCRIPT_NAME"]."?sections&pid=".$entityId ?>" class="childLink" title="VIEW" target="<?php echo $target ?>">VIEW</a>
															</td>
															<td><?php echo $result["entity_creation_date"] ?></td>
															<?php
																if(isset($widgetWhiteList))
																{
																	if(in_array($pid, $widgetWhiteList) || ($parentEntity!==false && in_array($parentEntity["entity_type"], $widgetWhiteList, true)))
																	{
																		if($template!==false && isset($template["hasWidget"]) && $template["hasWidget"]===true)
																		{
																			?>
																				<td><a href="<?php echo $_SERVER["SCRIPT_NAME"]."?widgets&pid=".$entityId."&page=".$page ?>" class="childLink" title="View" target="<?php echo $target ?>">VIEW</a></td>
																			<?php
																		}
																		else
																		{
																			?><td style="text-align:center">-</td><?php
																		}
																	}
																}
															?>
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
															<td class="typeColumn">
																<?php
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
															<td><?php echo $result["entity_order"] ?></td>
															<td><a href="<?php echo $_SERVER["SCRIPT_NAME"]."?editSection&eid=".$entityId."&page=".$page ?>" class="linkButton btn blue" target="<?php echo $target ?>">EDIT  <img src="img/x-square.png" alt=""></a></td>
														</tr>
													<?php
												}
											?>
										</tbody>
									</table>
								</form>
								<?php
									if($pages > 1)
									{
										$baseLink = SECTION_LINK;
										?>
											<form action="<?php echo $_SERVER["SCRIPT_NAME"] ?>" method="get" name="pagerForm">
												<input type="hidden" name="sections" />
												<input type="hidden" name="pid" value="<?php echo $pid ?>" />
												<?php
													if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" )
													{
														$baseLink .= "&keyword=".htmlspecialchars($_GET["keyword"], ENT_QUOTES);
														?>
															<div class="search-wrap">
																<input type="hidden" name="keyword" value="<?php echo htmlspecialchars($_GET["keyword"], ENT_QUOTES) ?>" />
															</div>
														<?php
													}
												?>
												<div class="myPagination align-center">

														<?php
															if($page > 1)
															{
																?>
																	<a class="btn green" href="<?php echo $baseLink."&page=".($page-1) ?>">⇐</a>
																<?php
															}
														?>

													<div class="inputTd select-element">
														<select name="page" onchange="document.pagerForm.submit()" class="form-control">
															<?php
																for($i=1; $i<=$pages; $i++)
																{
																	$selected = "";

																	if($i===$page)
																	{
																		$selected = "selected";
																	}
																	?>
																		<option <?php echo $selected ?> value="<?php echo $i ?>"><?php echo $i ?></option>
																	<?php
																}
															?>
														</select>
													</div>
													<div>
														<?php
															if($page < $pages)
															{
																?>
																	<a class="btn green" href="<?php echo $baseLink."&page=".($page+1) ?>">⇒</a>
																<?php
															}
														?>
													</div>
												</div>
											</form>
										<?php
									}
								?>
							</section>
						<?php
				}
			}
		}
	}
	else
	{
		?><meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["SCRIPT_NAME"]."?sections&pid=0" ?>"><?php
	}
?>
</div>
