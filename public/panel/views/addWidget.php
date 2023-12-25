<?php
	if( !defined("APP") )
	{
		exit("ERROR");
	}
?>
<div class="form position-relative top-pad">
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
					metaRefresh($_SERVER["SCRIPT_NAME"]);
				}
				else
				{
					define("SECTION_LINK", "?addWidget&pid=".$pid."&page=".$page);
					
					if( isset($_POST["add"]) )
					{
						$entityId = createEntity($pid, 1);
						if($entityId!==false)
						{
							saveTemplate($entityId);
							
							saveGallery($entityId);
							
							saveFields($entityId, $seoFields);
							
							if(USER_TYPE==="ROOT" || USER_TYPE==="ADMIN")
							{
								saveRole($entityId);
							}
							elseif($parentEntity!==false && $parentEntity["entity_role"])
							{
								setRole($entityId, $parentEntity["entity_role"]);
							}
							
							saveVisibility($entityId);
							
							if( isset($_POST["template"]) && is_string($_POST["template"]) )
							{
								$template = searchTemplate($_POST["template"]);
								if($template!==false)
								{
									if( isset($template["onAdd"]) && is_callable($template["onAdd"]) )
									{
										$template["onAdd"]($entityId);
									}
								}
							}
							
							metaRefresh("?widgets&pid=".$pid."&page=".$page);
						}
					}
					?>
						<section id="welcome" class="tm-section tabs-wrapper">
							<form action="<?php echo SECTION_LINK ?>" method="post" class="contact-form" enctype="multipart/form-data">
								<div class="top-section-funktional">
									<a href="<?php echo $_SERVER["SCRIPT_NAME"]."?widgets&pid=".$pid."&page=".$page ?>" class="south-east btn blue"> Back <img src="img/back.png" alt=""></a>
									
									<button type="submit" name="add" class="tm-button btn green">Add <img src="img/plus-square.svg" alt=""> </button>
									
								</div>
								<div class="form-group select-element first-select">
									<select name="template" class="form-control" onchange="chooseTemplate('<?php echo SECTION_LINK ?>', this.value)">
										<option value="">Select template</option>
										<?php
											$selectedTemplate = false;
											
											if( isset($_GET["tpl"]) && is_string($_GET["tpl"]) )
											{
												$selectedTemplateId = $_GET["tpl"];
											}
											elseif($parentEntity!==false)
											{
												$selectedTemplateId = $parentEntity["entity_sub_type"];
											}
											else
											{
												$selectedTemplateId = false;
											}
											
											foreach($templates as $template)
											{
												if($template["isWidget"]===true)
												{
													if( isset($templateMap) && isset($templateMap[$pid]) )
													{
														if( !in_array($template["id"], $templateMap[$pid]) )
														{
															continue;
														}
													}
													
													if($parentEntity!==false)
													{
														$parentTemplate = $parentEntity["entity_type"];
														
														if( isset($templateChildren) && isset($templateChildren[$parentTemplate]) )
														{
															if( !in_array($template["id"], $templateChildren[$parentTemplate]) )
															{
																continue;
															}
														}
													}
													
													$selected = "";
													
													if($template["id"]===$selectedTemplateId)
													{
														$selectedTemplate = $template;
														
														$selected = "selected";
													}
													?>
														<option <?php echo $selected ?> value="<?php echo $template["id"] ?>"><?php echo $template["title"] ?></option>
													<?php
													}
											}
										?>
									</select>
								</div>
								<section class="tabs-section">
								<?php
									if($selectedTemplate!==false)
									{
										?>
											<section class="tab">
												<div class="tabs-title">Fields</div>
												<div class="fieldRow">
												
													<?php
														foreach($selectedTemplate["fields"] as $templateField)
														{
															printFormField($templateField, false);
														}
													?>
												</div>
											</section>
											<?php
												if($selectedTemplate["hasGallery"])
												{
													?>
													<section class="tab">
														<div class="tabs-title">Gallery</div>
														<div class="fieldRow">
															<tbody>
																<tr>
																	<td><input type="file" multiple name="gallery[]"></td>
																</tr>
															</tbody>
														</div>
													</section>
													<?php
												}
												
												if($selectedTemplate["hasSeo"])
												{
													?>
													<section class="tab">
														<div class="tabs-title">SEO</div>
														<div class="fieldRow">
															<?php
																foreach($seoFields as $seoField)
																{
																	printFormField($seoField, false);
																}
															?>
														</div>
													</section>
													
													<?php
												}
											?>
											<section class="tab">
												<div class="tabs-title">Settings</div>
												<div class="fieldRow">
													<div class="input-sections">
														<div class="flex-wrapper align-justify">
															<div class="title">
																Visibility
															</div>
														</div>
														<div class="inputTd form-group select-element">
															<select name="visibility" class="form-control">
																<?php
																	$visibilityOptions = array("Hidden", "Visible");
																	
																	foreach($visibilityOptions as $key=>$val)
																	{
																		$selected = "";
																		
																		if($key===1)
																		{
																			$selected = "selected";
																		}
																		
																		?>
																			<option <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $val ?></option>
																		<?php
																	}
																?>
															</select>
														</div>
													</div>
													<?php
														if(USER_TYPE==="ROOT" || USER_TYPE==="ADMIN")
														{
															$roles = getRoles();
															if( count($roles) > 0 )
															{
																?>
																	<div class="input-sections">
																		<div class="flex-wrapper align-justify">
																			<div class="title">
																				Role
																			</div>
																		</div>
																		<div class="inputTd form-group select-element">
																			<select name="role" class="form-control">
																				<option value="">None</option>
																				<?php
																					foreach($roles as $role)
																					{
																						?>
																							<option value="<?php echo $role["role_id"] ?>"><?php echo $role["role_name"] ?></option>
																						<?php
																					}
																				?>
																			</select>
																		</div>
																	</div>
																<?php
															}
														}
													?>
													</div>
												</div>
											</section>
										<?php
									}
								?>
								</section>
							</form>
						</section>
					<?php
				}
			}
		}
	?>
</div>
