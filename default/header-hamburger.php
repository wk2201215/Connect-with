
    

<div class="hamburger-menu" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="menu-content" id="menu">
        <a href="administrator-userList.php">User List</a>
        <a href="administrator-Delete-post.php">Post Deletion</a>
        <a href="view.php">view</a>
        <!-- Add more links as needed -->
    </div>  
    <script>
        function toggleMenu(){
            var menu = document.getElementById('menu');
            if(menu.style.display === 'block'){
                menu.style.display = 'none';
            }else{
                menu.style.display = 'block';
            }
        }
        </script>
