<div class="container" style="margin: 0; padding: 0;">
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 20px 20px; background-color: #343a40; color: white; width: 100vw; box-sizing: border-box; height: 100px;">
      <!-- Title -->
      <a href="/" style="text-decoration: none; color: #f8f9fa; font-size: 24px; font-weight: bold; display: flex; align-items: center;">
        <span>EMPLOYEE LEAVE MANAGEMENT SYSTEM</span> <!-- Logo removed -->
      </a>

      <!-- Navigation Menu -->
      <nav style="display: flex; gap: 15px; flex-wrap: wrap;">
        <a href="/adminhome" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Home</a>
        <a href="/viewUser" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">View User</a>
        <a href="/activeUser" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Active User</a>
        <a href="/inactiveUser" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Inactive User</a>
        <a href="/appliedLeave" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Applied Leave</a>
        <a href="/approvedLeave" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Approved Leave</a>
        <a href="/rejectedLeave" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Rejected Leave</a>
        <a href="/adminchangePassword" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Change Password</a>
        <a href="/logout" style="color: white; text-decoration: none; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s;">Logout</a>
      </nav>
    </header>
</div>

<!-- Hover Effects and Responsive Design -->
<style>
  a:hover {
      background-color: rgba(255, 255, 255, 0.1);
  }

  /* Full width for header */
  body, html {
    margin: 0;
    padding: 0;
    height: 100%; /* Ensure body takes up full height */
    background-image: url('{{ asset('images/no2.jpeg') }}'); /* Set background image */
    background-size: cover; /* Make sure the image covers the whole background */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Prevent the background from repeating */
    background-attachment: fixed; /* Keep the background fixed while scrolling */
  }

  @media (max-width: 768px) {
    header {
      flex-direction: column;
      align-items: flex-start;
      padding: 20px;
      height: auto;
    }

    nav {
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
    }

    a {
      padding: 6px 8px;
    }
  }
</style>
