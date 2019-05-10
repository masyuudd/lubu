
					<ul class="nav pull-right">
						<!-- dashboard menu-->
						<li class="dropdown hidden-phone">	
							<a href="index.php">
								<i class="icon-reorder"></i>Dashboard
							</a>
						</li>
						<!-- Chart menu -->
						<li class="dropdown hidden-phone">						
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-bar-chart"></i>Chart
							</a>
							<ul class="dropdown-menu notifications">
                            	<li>
                                    <a href="../dashboard/chartpage.php?loc=ltoreh">
										<span class="icon orange"><i class="icon-map-marker"></i></span>
										<span class="message">Lubu Toreh</span>
										 
                                    </a>
                                </li>
								<li>
                                    <a href="../dashboard/chartpage.php?loc=lubusatu">
										<span class="icon orange"><i class="icon-map-marker"></i></span>
										<span class="message">Lubu Satu</span>
										 
                                    </a>
                                </li>
								                            	<li>
                                    <a href="../dashboard/chartpage.php?loc=lubudua">
										<span class="icon orange"><i class="icon-map-marker"></i></span>
										<span class="message">Lubu Dua</span>
										 
                                    </a>
                                </li>
								<li>
                                    <a href="../dashboard/chartpage.php?loc=talusatu">
										<span class="icon orange"><i class="icon-map-marker"></i></span>
										<span class="message">Talu Satu</span>
										 
                                    </a>
                                </li>
								<li>
                                    <a href="../dashboard/chartpage.php?loc=taludua">
										<span class="icon orange"><i class="icon-map-marker"></i></span>
										<span class="message">Talu Dua</span>
										 
                                    </a>
                                </li>
									
							</ul>
						</li>
						<!-- setting menu -->
						<li class="dropdown hidden-phone">						
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-cog"></i>Setting
							</a>
							<ul class="dropdown-menu notifications">
                            	<li>
                                    <a href="../dashboard/userspage.php">
										<span class="icon orange"><i class="icon-map-marker"></i></span>
										<span class="message">Users</span>
										 
                                    </a>
                                </li>
								<li>
                                    <a href="../dashboard/settingpage.php">
										<span class="icon orange"><i class="icon-map-marker"></i></span>
										<span class="message">Q Formula</span>
										 
                                    </a>
                                </li>
								                      	
							</ul>
						</li>
						
						<!-- user menu -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> user
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="<?php echo $logoutAction ?>"><i class="halflings-icon off"></i>Log out</a></li>
								
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				