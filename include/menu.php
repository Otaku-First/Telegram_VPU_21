<?php

require_once('../post/db_connect.php');

?>


<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu" style="overflow: hidden; ">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="../pages/main.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Головна
                            </a>
                            <div class="sb-sidenav-menu-heading">Взаємодія з учнями</div>
                             <a class="nav-link" href="send_message.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-paper-plane"></i></div>
                                Надіслати сповіщення
                            </a>
                             <a class="nav-link" href="call_schedule.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                                Розклад дзвінків
                            </a>
                             <a class="nav-link" href="timetable.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-week"></i></div>
                               Розклад уроків
                            </a>
                            <a class="nav-link" href="replacement.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-times"></i></div>
                                Заміни
                            </a>
                          
                            
                           <a class="nav-link" href="group_mangment.php">
                               <div class="sb-nav-link-icon"><i class="fas fa-calendar-times"></i></div>Менджер груп</a>
                            <!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">-->
                            <!--    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>-->
                            <!--    Pages-->
                            <!--    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
                            <!--</a>-->
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Системне</div>
                            <a class="nav-link" href="conect_settings.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Підключення бота
                            </a>
                            <a class="nav-link" href="p_users.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Користувачі
                            </a>
                            <a class="nav-link" href="conect_settings.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Групи
                            </a>
                            <!--<a class="nav-link" href="tables.html">-->
                            <!--    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>-->
                            <!--    Tables-->
                            <!--</a>-->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <? $get_name_for_menu_sql = mysqli_query($db,"SELECT `full_name` FROM `admins` WHERE email = '".$_SESSION['session_email']."'");

                        $get_name_for_menu_arr = mysqli_fetch_array($get_name_for_menu_sql);


                        ?>
                        <div class="small">Ви увійшли як:</div>
                      <? echo $get_name_for_menu_arr["full_name"];?>
                    </div>
                </nav>
            </div>