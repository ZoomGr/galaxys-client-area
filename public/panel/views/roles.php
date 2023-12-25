<?php
	if( !defined("APP") )
	{
		exit("ERROR");
	}
?>
<?php
	if(USER_TYPE!=="ROOT" && USER_TYPE!=="ADMIN")
	{
		exit("<meta http-equiv='refresh' content='0; url=".$_SERVER["SCRIPT_NAME"]."'>");
	}
	else
	{
		?>
			<div class="form">
				<?php
					define("SECTION_LINK", $_SERVER["SCRIPT_NAME"]."?roles");
					
					$roleId = (string)filter_input(INPUT_GET, "roleId", FILTER_VALIDATE_INT);
					if($roleId!=="")
					{
						$role = findRoleById($roleId);
						if($role!==FALSE)
						{
							define("FORM_LINK", SECTION_LINK."&roleId=".$roleId);
							
							if( isset($_POST["update"]) )
							{
								$roleName = (string)filter_input(INPUT_POST, "roleName");
								if($roleName!=="")
								{
									$similarRole = findRoleByName($roleName);
									if($similarRole===false)
									{
										$queryResult = $db->request("UPDATE roles SET role_name=? WHERE role_id=?", array($roleName, $roleId));
										if($queryResult===1)
										{
											$_SESSION["success"] = "Saved";
											
											exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
										}
										else
										{
											$_SESSION["error"] = "Internal error";
											
											exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
										}
									}
									else
									{
										if($similarRole["role_id"]!==$role["role_id"])
										{
											$_SESSION["error"] = "Similar role exists";
											
											exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
										}
										else
										{
											$_SESSION["success"] = "No changes were made";
											
											exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
										}
									}
								}
								else
								{
									$_SESSION["error"] = "Invalid input";
									
									exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
								}
							}
							elseif( isset($_POST["delete"]) )
							{
								$queryResult = $db->request("DELETE FROM user_roles WHERE ur_role=?", array($roleId));
								if($queryResult!==-1)
								{
									$queryResult = $db->request("UPDATE entities SET entity_role=0 WHERE entity_role=?", array($roleId));
									if($queryResult!==-1)
									{
										$queryResult = $db->request("DELETE FROM roles WHERE role_id=?", array($roleId));
										if($queryResult===1)
										{
											$_SESSION["success"] = "Removed";
											
											exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
										}
										else
										{
											$_SESSION["error"] = "Internal error 3";
											
											exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
										}
									}
									else
									{
										$_SESSION["error"] = "Internal error 2";
										
										exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
									}
								}
								else
								{
									$_SESSION["error"] = "Internal error 1";
									
									exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
								}
							}
							?>
								<section id="welcome" class="tm-section">
									<form action="<?php echo FORM_LINK ?>" method="post" class="contact-form form-min-pading white-background-color  position-relative">
										<div class="form-group">
											<input type="text" id="roleName" name="roleName" class="form-control" placeholder="Name" value="<?php echo htmlspecialchars($role["role_name"], ENT_QUOTES) ?>" required/>
										</div>
										<div class="save-delete-funktional">
											<button type="submit" name="update" class="tm-button btn blue">Update <img src="img/x-square2.png" alt=""></button>
											&nbsp;&nbsp;&nbsp;
											<button type="submit" name="delete" class="deleteButton btn red">Delete  <img src="img/x-square1.png" alt=""></button>
										</div>
									</form>
								</section>
							<?php
						}
						else
						{
							$_SESSION["error"] = "Invalid role";
							
							exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
						}
					}
					else
					{
						if( isset($_POST["add"]) )
						{
							$roleName = (string)filter_input(INPUT_POST, "roleName");
							if($roleName!=="")
							{
								$similarRole = findRoleByName($roleName);
								if($similarRole===false)
								{
									$queryResult = $db->request("INSERT INTO roles (role_name) VALUES (?)", array($roleName));
									if($queryResult===1)
									{
										$_SESSION["success"] = "Saved";
										
										exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
									}
									else
									{
										$_SESSION["error"] = "Internal error";
										
										exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
									}
								}
								else
								{
									$_SESSION["error"] = "Similar role exists";
									
									exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
								}
							}
							else
							{
								$_SESSION["error"] = "Invalid input";
								
								exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
							}
						}
						?>
							<section id="welcome" class="tm-section">
								<header>
									<h2 class="tm-blue-text tm-welcome-title tm-margin-b-45">Roles</h2>
								</header>
								<form action="<?php echo SECTION_LINK ?>" method="post" class="contact-form first-select form-min-pading white-background-color">
									<div class="form-group">
										<input type="text" id="roleName" name="roleName" class="form-control" placeholder="Name"  required/>
									</div>
									<div class="btn-margin">
										<button type="submit" name="add" class="tm-button btn green">Add <img src="img/plus-square.svg" alt=""></button>
									</div>
								</form>
								<?php
									$roles = getRoles();
									if( count($roles) > 0 )
									{
										?>
										
											<div class="contact-form form-pading white-background-color border-rad top-bottom-marg">
												<table border="1" cellpadding="5" cellspacing="0" class="report">
													<thead>
														<tr>
															<th>ID</th>
															<th>Name</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach($roles as $key=>$role)
															{
																?>
																	<tr>
																		<td><?php echo $role["role_id"] ?></td>
																		<td><?php echo $role["role_name"] ?></td>
																		<td><a href="<?php echo SECTION_LINK."&roleId=".$role["role_id"] ?>" class="linkButton  btn blue">EDIT <img src="img/x-square.png" alt=""></a></td>
																	</tr>
																<?php
															}
														?>
													</tbody>
												</table>
											</div>
										<?php
									}
								?>
							</section>
						<?php
					}
				?>
			</div>
		<?php
	}
?>