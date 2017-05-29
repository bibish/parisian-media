<header id="menu_header">







        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php"><img src="img/logo.png" alt="logo" width="90" height="55"></a>
                </li>
                <li <?php if($filename == 'podcast.php') echo 'class="active"'?> >
                    <a href="podcast.php">LE PODCAST</a>
                </li>
                <li <?php if($filename == 'insider.php') echo 'class="active"'?> >
                    <a href="insider.php">L'INSIDER</a>
                </li>
                <li <?php if($filename == 'truc.php') echo 'class="active"'?> >
                    <a href="truc.php">LE TRUC</a>
                </li>
                <li <?php if($filename == 'concept.php') echo 'class="active"'?> >
                    <a href="concept.php">LE CONCEPT</a>
                </li>
                <li <?php if($filename == 'archives.php') echo 'class="active"'?> >
                    <a href="archives.php">LES ARCHIVES</a>
                </li>
                <li <?php if($filename == 'contact.php') echo 'class="active"'?> >
                    <a href="contact.php">CONTACT</a>
                </li>
            </ul>
        </nav>
        <div class="menu-collapsed">
            <div class="bar"></div>
            <nav id="menu-res">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="podcast.php">LE PODCAST</a></li>
                    <li><a href="insider.php">L'INSIDER</a></li>
                    <li><a href="truc.php">LE TRUC</a></li>
                    <li><a href="concept.php">LE CONCEPT</a></li>
                    <li><a href="archives.php">LES ARCHIVES</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                </ul>
            </nav> 
        </div> 
</header>

<?php
    flash_out();
    ?>