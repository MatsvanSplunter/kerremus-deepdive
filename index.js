document.getElementById('login').addEventListener('click', function() {
  window.location.href = 'login_register.php?login_register=!login';    
  });

  document.getElementById('logout').addEventListener('click', function() {
    window.location.href = 'logout.php';    
    });

document.getElementById('newGameBtn').addEventListener('click', function() {
    document.getElementById('mainMenu').style.display = 'none';
    document.getElementById('newGameMenu').style.display = 'flex';
    document.getElementById('name').style.display = 'none';
    document.getElementById('name2').style.display = 'block';
  });
  
  document.getElementById('loadGameBtn').addEventListener('click', function() {
    document.getElementById('mainMenu').style.display = 'none';
    document.getElementById('loadGameMenu').style.display = 'flex';
    document.getElementById('name').style.display = 'none';
    document.getElementById('name3').style.display = 'block';
  })

  document.getElementById('backBtn').addEventListener('click', function() {
    document.getElementById('newGameMenu').style.display = 'none';
    document.getElementById('mainMenu').style.display = 'flex';
    document.getElementById('name').style.display = 'block';
    document.getElementById('name2').style.display = 'none';
  });
  
  document.getElementById('backBtn2').addEventListener('click', function() {
    document.getElementById('loadGameMenu').style.display = 'none';
    document.getElementById('mainMenu').style.display = 'flex';
    document.getElementById('name').style.display = 'block';
    document.getElementById('name3').style.display = 'none';
  });

  document.getElementById('small').addEventListener('click', function() {
    window.location.href = 'index.php';    
  })