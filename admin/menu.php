<aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftside-navigation">
                    <li class="user-details cyan darken-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <img src="<?php echo $_SESSION['gambar']; ?>" alt="" style="border: 2px solid white;" class="circle responsive-img valign profile-image">
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown" class="dropdown-content">
                                    <li><a href="detail-admin.php?id=<?php echo $_SESSION['user_id']; ?>"><i class="mdi-action-face-unlock"></i> Profile</a>
                                    </li>
                                    <!--<li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
                                    </li>
                                    <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="mdi-action-lock-outline"></i> Lock</a>
                                    </li>-->
                                    <li><a href="../logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                    </li>
                                </ul>
                                <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $_SESSION['fullname']; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                                <p class="user-roal"><?php echo $_SESSION['level']; ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                    </li>
                    <?php
                    $tanggal = date("D/m/y");
                     $tampil2=mysqli_query($koneksi, "select * from tiket where status='open'");
                        $total2=mysqli_num_rows($tampil2);
                        ?>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-communication-email"></i> Helpdesk <span class="new badge"><?php echo $total2; ?></span></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="tiket.php">Data Helpdesk</a>
                                        </li>                                        
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>   
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-social-person"></i> Pengguna </a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="admin.php">Data Pengguna</a>
                                        </li>                                        
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                            <li class="bold"><a href="../logout.php"><i class="mdi-action-exit-to-app"></i> Logout </a>
                            </li>
                    </li>     
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2"><i class="mdi-navigation-menu" ></i></a>
            </aside>