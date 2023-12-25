<?php
	function printFormField($field, $entity)
	{
		global $languages;
		
		$fieldName = $field["name"];
		
		$fieldPrefix = parseColumnPrefix($fieldName);
		
		$tableName = getTableName($fieldPrefix);
		
		$multilang = isMultiLang($tableName);
		
		if( isset($field["required"]) && $field["required"]===true )
		{
			$required = "required";
		}
		else
		{
			$required = "";
		}
		?>
			<div class="input-sections">
				<div class="flex-wrapper align-justify ">
					<div class="title">
						<?php
							echo $field["title"];
							
							if($field["type"]==="picker")
							{
								$pickerUrl = $_SERVER["SCRIPT_NAME"]."?sections&pid=".$field["pid"];
								?>
									<a class="picker" onclick="pick('<?php echo $pickerUrl ?>', '<?php echo $fieldName ?>')"><img src="img/plus-square-blue.svg" ></a>
								<?php
							}
						?>
					</div>
					<div class="language-wrapper">
						<?php
							if($multilang===true)
							{
								foreach($languages as $ind=>$language)
								{
									$checked = "";
									if($ind===0)
									{
										$checked = "checked='checked'";
									}
									?>
										<div class="langSwitch">
											<input <?php echo $checked ?> type="radio" id="radio_<?php echo $fieldName."_".$ind ?>" name="radio_<?php echo $fieldName ?>"><label for="radio_<?php echo $fieldName."_".$ind ?>"><?php echo $language["language_url"] ?></label>
										</div>
									<?php
								}
							}
						?>
					</div>
				</div>
				<div class="inputTd">
					<?php
						if($multilang===true)
						{
							foreach($languages as $language)
							{
								if($entity !== false)
								{
									$fieldValue = searchLangValue($field, $language, $entity);
								}
								else
								{
									$languageId = $language["language_id"];
									
									if( isset($field["value"]) && is_array($field["value"]) && isset( $field["value"][$languageId] ) )
									{
										$fieldValue = $field["value"][$languageId];
									}
									else
									{
										$fieldValue = "";
									}
								}
								
								if($field["type"]==="text")
								{
									?>
										<input type="text" <?php echo $required ?> name="<?php echo $fieldName ?>[]" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" />
									<?php
								}
								elseif($field["type"]==="url")
								{
									?>
										<input type="url" <?php echo $required ?> name="<?php echo $fieldName ?>[]" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" />
									<?php
								}
								elseif($field["type"]==="email")
								{
									?>
										<input type="email" <?php echo $required ?> name="<?php echo $fieldName ?>[]" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" />
									<?php
								}
								elseif($field["type"]==="image")
								{
									$style = "";
									
									if($fieldValue!=="")
									{
										$style = "background-image:url(".$fieldValue.");";
									}
									?>

									<div class="inputFile align-mid">
										<div class="file-img-container align-center">
											<div class="file-img-title">
												Upload photo <img src="img/upload-cloud.png" alt="">
											</div>
											<div class="file-img" style="<?php echo $style ?>">
											
											</div>
											<input type="file" <?php echo $required ?> name="<?php echo $fieldName ?>[]" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" accept="image/*" />
											<?php
												if($fieldValue!=="")
												{
													?>
														<a class="delFile" href="<?php echo SECTION_LINK."&file=".$fieldName."&language=".$language["language_id"] ?>"></a>
													<?php
												}
											?>
										</div>
									</div>
									<?php
								}
								elseif($field["type"]==="file")
								{
									?>
										<div class="inputFile">
											<input type="file" <?php echo $required ?> name="<?php echo $fieldName ?>[]" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" />
											<?php
												if($fieldValue!=="")
												{
													?>
														<a class="delFile" href="<?php echo SECTION_LINK."&file=".$fieldName."&language=".$language["language_id"] ?>"></a>
													<?php
												}
											?>
										</div>
									<?php
								}
								elseif($field["type"]==="textarea")
								{
									$class = "form-control";
									
									if($field["isRichText"])
									{
										$class .= " richText";
									}
									?>
										<textarea <?php echo $required ?> name="<?php echo $fieldName ?>[]" class="<?php echo $class ?>" rows="5"><?php echo htmlspecialchars($fieldValue) ?></textarea>
									<?php
								}
							}
						}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						else
						{
							if($field["type"]==="picker" || $field["type"]==="multiselect" || $field["type"]==="multioptgroup")
							{
								if($entity !== false)
								{
									$fieldValues = getOptionValues($field, $entity);
								}
								else
								{
									if( isset($field["value"]) && is_array($field["value"]) )
									{
										$fieldValues = $field["value"];
									}
									else
									{
										$fieldValues = array();
									}
								}
							}
							else
							{
								if($entity !== false)
								{
									$fieldValue = searchValue($field, $entity);
								}
								else
								{
									if( isset($field["value"]) )
									{
										$fieldValue = $field["value"];
									}
									else
									{
										$fieldValue = "";
									}
								}
							}
							
							if($field["type"]==="text")
							{
								?>
									<input type="text" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" />
								<?php
							}
							elseif($field["type"]==="color")
							{
								?>
									<input type="color" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control color-picker" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" style="padding:0 0 0 0" />
								<?php
							}
							elseif($field["type"]==="url")
							{
								?>
									<input type="url" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" />
								<?php
							}
							elseif($field["type"]==="email")
							{
								?>
									<input type="email" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" value="<?php echo htmlspecialchars($fieldValue, ENT_QUOTES) ?>" />
								<?php
							}
							elseif($field["type"]==="number")
							{
								?>
									<input type="number" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" value="<?php echo $fieldValue ?>" />
								<?php
							}
							elseif($field["type"]==="datetime")
							{
								?>
									<input type="datetime-local" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" value="<?php echo str_replace(" ", "T", $fieldValue) ?>" />
								<?php
							}
							elseif($field["type"]==="date")
							{
								?>
									<input type="date" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" value="<?php echo substr($fieldValue, 0, 10) ?>" />
								<?php
							}
							elseif($field["type"]==="time")
							{
								?>
									<input type="time" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" value="<?php echo substr($fieldValue, 0, 5) ?>" />
								<?php
							}
							elseif($field["type"]==="image")
							{
								$style = "";
								
								if($fieldValue!=="")
								{
									$style = "background-image:url(".$fieldValue.");";
								}
								?>
									<div class="inputFile align-mid">
										<div class="file-img-container align-center">
											<div class="file-img-title">
												Upload photo <img src="img/upload-cloud.png" alt="">
											</div>
											<div class="file-img" style="<?php echo $style ?>">
											
											</div>
											<input type="file" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" accept="image/*" />

											<?php
												if($fieldValue!=="")
												{
													?>
														<a class="delFile" href="<?php echo SECTION_LINK."&file=".$fieldName ?>"></a>
													<?php
												}
											?>
										</div>
									</div>
								<?php
							}
							elseif($field["type"]==="file")
							{
								?>
									<div class="inputFile">
										<input type="file" <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control" />
										<?php
											if($fieldValue!=="")
											{
												?>
													<a class="delFile" href="<?php echo SECTION_LINK."&file=".$fieldName ?>"></a>
													
													<a class="downloadFile" href="<?php echo $fieldValue ?>" target="_blank" title="Download"><img src="img/save.png" alt="" /></a>
												<?php
											}
										?>
									</div>
								<?php
							}
							elseif($field["type"]==="textarea")
							{
								$class = "form-control";
								
								if($field["isRichText"])
								{
									$class .= " richText";
								}
								?>
									<textarea <?php echo $required ?> name="<?php echo $fieldName ?>" class="<?php echo $class ?>" rows="5"><?php echo htmlspecialchars($fieldValue) ?></textarea>
								<?php
							}
							elseif($field["type"]==="select")
							{
								?>
									<select <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control">
                                        <option value="">None</option>
										<?php
											if( is_callable($field["pid"]) )
											{
												$options = execOptionSource($field["pid"], $entity);
											}
											else
											{
												$options = getSingleLevelOptions($field["pid"]);
											}
											
											foreach($options as $key=>$val)
											{
												$selected = "";
												
												if($fieldValue===$key)
												{
													$selected = "selected";
												}
												?>
													<option <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $val ?></option>
												<?php
											}
										?>
									</select>
								<?php
							}
							elseif($field["type"]==="multiselect")
							{
								if( is_callable($field["pid"]) )
								{
									$options = execOptionSource($field["pid"], $entity);
								}
								else
								{
									$options = getSingleLevelOptions($field["pid"]);
								}
								?>
									<select <?php echo $required ?> multiple name="<?php echo $fieldName ?>[]" class="form-control" size="<?php echo count($options) ?>">
										<?php
											foreach($options as $key=>$val)
											{
												$selected = "";
												
												if( in_array($key, $fieldValues) )
												{
													$selected = "selected";
												}
												?>
													<option <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $val ?></option>
												<?php
											}
										?>
									</select>
								<?php
							}
							elseif($field["type"]==="optgroup")
							{
								?>
									<select <?php echo $required ?> name="<?php echo $fieldName ?>" class="form-control">
                                        <option value="">None</option>
										<?php
											if( is_callable($field["pid"]) )
											{
												$optgroups = execOptionSource($field["pid"], $entity);
											}
											else
											{
												$optgroups = getMultiLevelOptions($field["pid"]);
											}
											
											foreach($optgroups as $optgroup)
											{
												?>
													<optgroup label="<?php echo htmlspecialchars($optgroup["title"]) ?>">
														<?php
															foreach($optgroup["options"] as $key=>$val)
															{
																$selected = "";
																
																if($fieldValue===$key)
																{
																	$selected = "selected";
																}
																?>
																	<option <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $val ?></option>
																<?php
															}
														?>
													</optgroup>
												<?php
											}
										?>
									</select>
								<?php
							}
							elseif($field["type"]==="multioptgroup")
							{
								if( is_callable($field["pid"]) )
								{
									$optgroups = execOptionSource($field["pid"], $entity);
								}
								else
								{
									$optgroups = getMultiLevelOptions($field["pid"]);
								}
								?>
									<select <?php echo $required ?> multiple name="<?php echo $fieldName ?>[]" class="form-control" size="<?php echo countMultiLevelOptions($optgroups) ?>">
										<?php
											foreach($optgroups as $optgroup)
											{
												?>
													<optgroup label="<?php echo htmlspecialchars($optgroup["title"]) ?>">
														<?php
															foreach($optgroup["options"] as $key=>$val)
															{
																$selected = "";
																
																if( in_array($key, $fieldValues) )
																{
																	$selected = "selected";
																}
																?>
																	<option <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $val ?></option>
																<?php
															}
														?>
													</optgroup>
												<?php
											}
										?>
									</select>
								<?php
							}
							elseif($field["type"]==="picker")
							{
								?>
									<table class="pickedData" id="<?php echo $fieldName ?>">
										<tbody>
												<?php
													if( count($fieldValues) > 0 )
													{
														$pickedList = getFixedEntities($fieldValues);
														foreach($pickedList as $pickedRow)
														{
															$bgStyle = "";
															
															if( is_file($pickedRow[IMG_FIELD]) )
															{
																$bgStyle = "background-image:url('".$pickedRow[IMG_FIELD]."')";
															}
															
															?>
															<tr class="pickRow_<?php echo $pickedRow["entity_id"] ?>">
																<td>
																	<div class="file-img-container align-center">
																		<div class="file-img-title" style="  min-width: 60px;text-align: center;">
																			<img src="img/picture.png" alt="">
																		</div>
																		<div class="imageColumn file-img" >
																			<div>&nbsp;
											
																			</div>
																		</div>
																	</div>
																</td>
																<td>
																	<div class="pickedTitle"><?php echo $pickedRow[TITLE_FIELD] ?></div>
																</td>
																<td>
																	<div class="pickedDelete"><input type='hidden' name='<?php echo $fieldName ?>[]' value='<?php echo $pickedRow["entity_id"] ?>'><span class="deliteSection" onclick='removePickedRow(this)'></span></div>
																</td>
																<td>
																	<div class="moving" ></div>
																</td>	
																
															</tr>
															<?php
														}
													}
												?>
										</tbody>
									</table>
								<?php
							}
						}
					?>
				</div>
			</div>
		<?php
	}
?>
