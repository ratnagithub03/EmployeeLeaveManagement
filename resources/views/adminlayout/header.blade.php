<div class="container" style="margin: 0; padding: 0;">
    <header style="display: flex; justify-content: center; align-items: center; padding: 10px 20px; background: #4a90e2; color: white; width: 100vw; box-sizing: border-box; height: 80px;">
        <!-- Title Centered with Enhanced Styling -->
        <a href="/" style="text-decoration: none; color: #f8f9fa; font-size: 36px; font-weight: bold; display: flex; align-items: center; letter-spacing: 1.5px; text-transform: uppercase; font-family: 'Roboto', sans-serif; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);">
            <span>EMPLOYEE LEAVE MANAGEMENT SYSTEM</span> <!-- Logo removed -->
        </a>
    </header>
</div>

<!-- Body Section with Navigation Items as Cards -->
<div class="container" style="padding: 40px 20px;">
    <section class="card-container" style="display: flex; gap: 20px; flex-wrap: wrap; justify-content: center;">
        <!-- Navigation Items as Cards -->
        <div class="nav-card">
            <a href="/adminhome">Home</a>
        </div>
        <div class="nav-card">
            <a href="/viewUser">View User</a>
        </div>
        <div class="nav-card">
            <a href="/activeUser">Active User</a>
        </div>
        <div class="nav-card">
            <a href="/inactiveUser">Inactive User</a>
        </div>
        <div class="nav-card">
            <a href="/appliedLeave">Applied Leave</a>
        </div>
        <div class="nav-card">
            <a href="/approvedLeave">Approved Leave</a>
        </div>
        <div class="nav-card">
            <a href="/rejectedLeave">Rejected Leave</a>
        </div>
        <div class="nav-card">
            <a href="/adminchangePassword">Change Password</a>
        </div>
        <div class="nav-card">
            <a href="/logout">Logout</a>
        </div>
    </section>
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
        background-image: url('{{ asset('images/no2.jpeg') }}'); 
        background-size: cover; /* Make sure the image covers the whole background */
        background-position: center; /* Center the background image */
        background-repeat: no-repeat; /* Prevent the background from repeating */
        background-attachment: fixed; /* Keep the background fixed while scrolling */
    }

    /* Center title in the header */
    header {
        text-align: center;
    }

    /* Card styling for nav items */
    .nav-card {
        background: linear-gradient(135deg, #6c63ff, #ab47bc); /* Gradient background */
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); /* More pronounced shadow */
        transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
        flex: 1 1 calc(30% - 40px); /* Three cards per row */
        max-width: calc(30% - 40px); /* Ensure max width */
        text-align: center;
        color: white;
        font-size: 18px;
        font-weight: bold;
        position: relative;
        overflow: hidden;
    }

    /* Add subtle hover effect */
    .nav-card:hover {
        transform: translateY(-10px); /* Lift the card slightly */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4); /* Larger shadow on hover */
        background: linear-gradient(135deg, #ff6b6b, #f06595); /* Change gradient on hover */
    }

    .nav-card a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px;
        font-size: 20px;
        transition: color 0.3s;
    }

    .nav-card a:hover {
        color: #ffeb3b; /* Change text color on hover */
    }

    /* Media queries for responsiveness */
    @media (max-width: 768px) {
        header {
            flex-direction: column;
            align-items: center;
            padding: 20px;
            height: auto;
        }

        .card-container {
            flex-direction: column;
            gap: 20px;
        }

        .nav-card {
            width: 100%;
        }
    }
</style>

<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
