<?php 
    require($_SERVER['DOCUMENT_ROOT'] . '/pages/main_page/utils/ticketDisplayer.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/database/loadTickets.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Manager</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>2
</head>

<body>
    <header id="header">
        <img id="feup_logo" src="images/feup_logo.png" alt="feup_logo.png" title="Lógotipo da FEUP">
        <h1>Ticket Manager</h1>
        
        <h2>Web Page developed for the Curricular Unit Languages and Technologies of the Web</h2>
        
        <h3>Developed by:</h3>
        <ul>
            <li>José Nuno Barbosa Quintas, up202108712</li>
            <li>Emanuel Rui Tavano Maia, up202107486</li>
        </ul>

        <div id="registry_section">
            <p>In order to enjoy Ticket Manager at its full potential, please:</p>
            <a href="../login.php">Sign In</a> | <a href="../register.php">Sign Up</a>
        </div>
    </header>

    <main>
        <div class="tab">
            <button class="tablinks active" onclick="openTab(event, 'Client')">Client</button>
            <button class="tablinks" onclick="openTab(event, 'Agent')">Agent</button>
            <button class="tablinks" onclick="openTab(event, 'Admin')">Admin</button>
        </div>

        
        <div id="Client" class="tabsection" style="display: block">
            <div id="searchOptions">
                <form action="main.php" method="get">
                    <label for="department" >Department: </label> <select id="departmentSelect" name="departmentChoice">
                        <option value="all">All Departments</option>
                        <option value="Support">Support</option>
                        <option value="Sales">Sales</option>
                        <option value="Marketing">Marketing</option>
                    </select>

                    <label for="sortOrder">&nbsp Sort by: </label> <select id="sortOrder" name="sortOrder">
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                    
                    <input type="submit" value="Search" id="searchButton">

                    <input type="text" id="ticketSearchBar" placeholder="Input your text here..." name="ticketSearchBar">
                </form>
            </div>
            
            <?php 
                $ticket_array = loadTickets(false);
                DisplayTickets($ticket_array);
            ?>
        </div>

        <div id="Agent" class="tabsection" style="display: none">
            <div id="searchOptions">
                <form action="main.php" method="get">
                    <label for="department" >Department: </label> <select id="departmentSelect" name="departmentChoice">
                        <option value="all">All Departments</option>
                        <option value="Support">Support</option>
                        <option value="Sales">Sales</option>
                        <option value="Marketing">Marketing</option>
                    </select>

                    <label for="sortOrder">&nbsp Sort by: </label> <select id="sortOrder" name="sortOrder">
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                    
                    <input type="submit" value="Search" id="searchButton">

                    <input type="text" id="ticketSearchBar" placeholder="Input your text here..." name="ticketSearchBar">
                </form>
            </div>
            
            <?php 
                $ticket_array = loadTickets(false);
                DisplayTickets($ticket_array);
            ?>
        </div>

        <div id="Admin" class="tabsection" style="display: none">
            <div id="searchOptions">
                <form action="main.php" method="get">
                    <label for="department" >Department: </label> <select id="departmentSelect" name="departmentChoice">
                        <option value="all">All Departments</option>
                        <option value="Support">Support</option>
                        <option value="Sales">Sales</option>
                        <option value="Marketing">Marketing</option>
                    </select>

                    <label for="sortOrder">&nbsp Sort by: </label> <select id="sortOrder" name="sortOrder">
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                    
                    <input type="submit" value="Search" id="searchButton">

                    <input type="text" id="ticketSearchBar" placeholder="Input your text here..." name="ticketSearchBar">
                </form>
            </div>
            
            <?php 
                $ticket_array = loadTickets(false);
                DisplayTickets($ticket_array);
            ?>
        </div>
    </main>
</body>
</html>