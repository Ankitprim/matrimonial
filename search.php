<?php
include("config/init.php");
include("config/database.php");
$obj = new query();
$result = [];
$searchQuery = "Try to search Name or user id.";

if (isset($_POST["search"])) {
    $searchQuery = htmlspecialchars($_POST["searchQuery"]);
    if ($searchQuery != "") {

        $result = $obj->getSearch($searchQuery);
        // var_dump($result);

    } else {
        $result = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap JS (required for modals & buttons) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css">
    <style>
        #search-container {
            margin-top: 3rem;
        }

        .search-container {
            /* max-width: 1200px;
            margin: 0 auto; */
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .search-header {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            padding: 150px 20px 20px 20px;
            text-align: center;
        }

        .search-header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .search-box {
            display: flex;
            justify-content: center;
            flex-direction: row;
            margin: 20px 0;
        }

        .search-box input {
            padding: 12px 15px;
            border: none;
            border-radius: 5px 0 0 5px;
            font-size: 1rem;
        }

        .search-box button {
            background: #333;
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-box button:hover {
            background: #555;
        }

        .search-options {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .search-options button {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-options button:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .filters-container {
            padding: 20px;
            display: none;
            background: #fff8f8;
            border-bottom: 2px solid #ff6b6b;
        }

        .filters-container.active {
            display: block;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filter-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }

        .filter-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter-buttons button.apply {
            background: #ff6b6b;
            color: white;
        }

        .filter-buttons button.reset {
            background: #ddd;
            color: #333;
        }

        .results-container {
            padding: 20px;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .results-count {
            font-weight: 500;
            color: #555;
        }

        .sort-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .user-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .user-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .user-card:hover {
            transform: translateY(-5px);
        }

        .user-image {
            height: 200px;
            overflow: hidden;
        }

        .user-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            padding: 15px;
        }

        .user-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #ff6b6b;
        }

        .user-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin: 10px 0;
        }

        .user-detail {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
        }

        .user-detail i {
            color: #ff6b6b;
        }

        .match-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .match-actions button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn-view {
            background: #ff6b6b;
            color: white;
        }

        .btn-message {
            background: #f0f0f0;
            color: #333;
        }

        .btn-view:hover {
            background: #ff5252;
        }

        .btn-message:hover {
            background: #e0e0e0;
        }

        .chat-area {
            flex: 1;
            display: none;
            flex-direction: column;
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--light-gray);
            padding-bottom: 5px;
        }

        .chat-user-img {
            width: 40px;
            height: 40px;
            border: 1px solid var(--light-gray);
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-area {
            flex: 1;
            display: none;
            flex-direction: column;
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--light-gray);
            padding-bottom: 5px;
        }

        .chat-user-img {
            width: 40px;
            height: 40px;
            border: 1px solid var(--light-gray);
            border-radius: 50%;
            object-fit: cover;
        }


        .chat-messages {
            flex: 1;
            overflow-y: auto;
            max-height: 350px;
            padding: 10px;
            background-color: var(--light);
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .message {
            padding: 10px 15px;
            border-radius: 18px;
            margin-bottom: 10px;
            max-width: 70%;
        }

        .message.received {
            background-color: white;
            align-self: flex-start;
            border-bottom-left-radius: 5px;
        }

        .message.sent {
            background-color: var(--primary);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
            margin-left: auto;
        }

        .message-input {
            display: flex;
            gap: 10px;
        }

        .message-input input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 20px;
        }


        .chat-messages {
            flex: 1;
            overflow-y: auto;
            max-height: 350px;
            padding: 10px;
            background-color: var(--light);
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .message {
            padding: 10px 15px;
            border-radius: 18px;
            margin-bottom: 10px;
            max-width: 70%;
        }

        .message.received {
            background-color: white;
            align-self: flex-start;
            border-bottom-left-radius: 5px;
        }
        .message.received>p{
            margin-bottom: 0px;
        }

        .message.sent {
            background-color: #ff1869ff;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
            margin-left: auto;
        }
        .message.sent>p{
            margin-bottom: 0px;
        }

        .message-input {
            display: flex;
            gap: 10px;
        }

        .message-input input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 20px;
        }


        .modal-footer input {
            flex: 1;
            margin-right: 5px;

        }

        .modal-footer input:focus {
            border: 1px;
            box-shadow: 0 0 0 3px rgba(255, 0, 106, 0.5);
        }

        .modal-footer button{
            background-color: #ff1869ff;
        }

        #profileModal {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 80px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background: rgba(0, 0, 0, 0.6);

        }

        .modal-header {
            border: 0px;
            gap:20px
        }
        .modal-header>h5{
            color:#ffffff;
        }

        .modal-body {
            background: linear-gradient(135deg, #ff829dff 0%, rgba(255, 112, 174, 1) 100%);
            border-radius: 20px 20px 0px 0px;
        }

        .modal-footer {
            border-top: 2px solid #ff4093ff;
            background: linear-gradient(135deg, #ff829dff 0%, rgba(255, 112, 174, 1) 100%);
            border-radius: 0px 0px 0px 20px;

        }

        .modal-footer>.btn-send {
            padding:7px 10px;
            border: 0px;
            border-radius: 5px;
            color:#ffffff;
            font-weight: 700;
            background-color: red;
        }

        .modal-content {
            background: linear-gradient(135deg, #ff6888ff 0%, #ff4093ff 100%);
            margin: auto;
            padding: 20px;
            border-radius: 12px;
            width: 500px;
            max-width: 90%;
            position: relative;
        }

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 22px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .search-box {
                flex-direction: column;
            }

            .search-box input {
                border-radius: 5px;
                margin-bottom: 10px;
            }

            .search-box button {
                border-radius: 5px;
            }

            .search-options {
                flex-wrap: wrap;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .results-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            /*             
            .user-cards {
                grid-template-columns: 1fr;
            } */
        }
    </style>
</head>

<body>
    <header>
        <?php include 'include/header.php'; ?>
    </header>
    <section>
        <div class="search-container">
            <div class="search-header ">
                <h1>Find Your Match</h1>
                <div class="search-box">
                    <form action="" method="post">
                        <input type="text" name="searchQuery" placeholder="Search by name or ID...">
                        <button type="submit" name="search"><i class="fas fa-search"></i> Search</button>
                    </form>
                </div>
                <div class="search-options">
                    <button id="toggleFilters"><i class="fas fa-filter"></i> Advanced Filters</button>
                    <!-- <button><i class="fas fa-id-card"></i> Search by ID</button> -->
                </div>
            </div>

            <div class="filters-container " id="filtersContainer">
                <div class="filter-grid container">
                    <div class="filter-group">
                        <label for="motherTongue">Mother Tongue</label>
                        <select id="motherTongue">
                            <option value="">Any</option>
                            <option value="english">English</option>
                            <option value="spanish">Spanish</option>
                            <option value="hindi">Hindi</option>
                            <option value="mandarin">Mandarin</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="income">Income</label>
                        <select id="income">
                            <option value="">Any</option>
                            <option value="0-30k">$0 - $30,000</option>
                            <option value="30k-60k">$30,001 - $60,000</option>
                            <option value="60k-100k">$60,001 - $100,000</option>
                            <option value="100k+">$100,000+</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" placeholder="Enter location...">
                    </div>

                    <div class="filter-group">
                        <label for="gender">Gender</label>
                        <select id="gender">
                            <option value="">Any</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="height">Height (cm)</label>
                        <select id="height">
                            <option value="">Any</option>
                            <option value="150-160">150 - 160 cm</option>
                            <option value="160-170">160 - 170 cm</option>
                            <option value="170-180">170 - 180 cm</option>
                            <option value="180+">180+ cm</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="education">Education</label>
                        <select id="education">
                            <option value="">Any</option>
                            <option value="highschool">High School</option>
                            <option value="bachelor">Bachelor's Degree</option>
                            <option value="master">Master's Degree</option>
                            <option value="phd">PhD</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="age">Age Range</label>
                        <select id="age">
                            <option value="">Any</option>
                            <option value="18-25">18 - 25</option>
                            <option value="26-35">26 - 35</option>
                            <option value="36-45">36 - 45</option>
                            <option value="46+">46+</option>
                        </select>
                    </div>
                </div>

                <div class="filter-buttons">
                    <button class="reset">Reset Filters</button>
                    <button class="apply">Apply Filters</button>
                </div>
            </div>

            <div class="results-container container">
                <div class="results-header">
                    <div class="results-count">Showing <?php echo count($result); ?> results</div>
                    <!-- <select class="sort-select">
                        <option>Sort by: Recommended</option>
                        <option>Sort by: Newest</option>
                        <option>Sort by: Age (Low to High)</option>
                        <option>Sort by: Age (High to Low)</option>
                    </select> -->
                </div>

                <div class="user-cards">
                    <!-- User Card 1 -->
                    <?php if ($result):
                        foreach ($result as $data): ?>
                            <div class="user-card">
                                <div class="user-image">
                                    <img src="uploads/<?php echo $data['image']; ?>" alt="User Photo">
                                </div>
                                <div class="user-info">
                                    <h3 class="user-name"><?php echo $data['full_name']; ?></h3>
                                    <div class="user-details">
                                        <div class="user-detail"><i class="fas fa-birthday-cake"></i>
                                            <?php echo $data['age']; ?> years</div>
                                        <div class="user-detail"><i class="fas fa-ruler-vertical"></i>
                                            <?php echo $data['height']; ?> cm</div>
                                        <div class="user-detail"><i class="fas fa-language"></i>
                                            <?php echo $data['motherTongue']; ?></div>
                                        <div class="user-detail"><i
                                                class="fas fa-map-marker-alt"></i><?php echo $data['location']; ?></div>
                                    </div>
                                    <!-- Replace this section in your search.php file -->
                                    <div class="match-actions">
                                        <button class="btn btn-primary openMessagePopup"
                                            data-id="<?php echo $data['user_id']; ?>"
                                            data-name="<?php echo htmlspecialchars($data['full_name']); ?>"
                                            data-image="<?php echo $data['image']; ?>">
                                            Message
                                        </button>

                                        <button class="btn btn-secondary view-profile"
                                            data-id="<?php echo $data['user_id']; ?>">
                                            View Profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    else: ?>
                        <h2>No search result found! <br> <?php echo $searchQuery; ?></h2>
                    <?php endif; ?>


                </div>
                <!-- Message Modal -->
                <div class="modal fade" id="messageModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img id="modalUserImage" src="uploads/default.png" class="chat-user-img">
                                <h5 id="modalUserName" class="modal-title"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div id="chatMessages" style="max-height:300px; overflow-y:auto;"></div>
                            </div>
                            <div class="modal-footer">
                                <input type="text" id="modalChatMessage" class="form-control"
                                    placeholder="Type your message...">
                                <button id="modalSendMessage" class="btn-send btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Profile Modal -->
                <div id="profileModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div id="profileData">Loading...</div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <footer>
        <?php include("include/footer.php"); ?>
    </footer>

    <script>
        // Toggle advanced filters
        document.getElementById('toggleFilters').addEventListener('click', function () {
            document.getElementById('filtersContainer').classList.toggle('active');
        });

        // Apply filters button
        document.querySelector('.filter-buttons .apply').addEventListener('click', function () {
            alert('Filters applied!');
            document.getElementById('filtersContainer').classList.remove('active');
        });

        // Reset filters button
        document.querySelector('.filter-buttons .reset').addEventListener('click', function () {
            const selects = document.querySelectorAll('.filters-container select');
            const inputs = document.querySelectorAll('.filters-container input');

            selects.forEach(select => {
                select.selectedIndex = 0;
            });

            inputs.forEach(input => {
                if (input.type !== 'button') {
                    input.value = '';
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {

            let chatInterval;
            let lastMessageId = 0;

            // Message Modal
            $(document).on("click", ".openMessagePopup", function () {
                let userId = $(this).data("id");
                let userName = $(this).data("name");
                let userImage = $(this).data("image");

                $("#modalUserName").text(userName);
                $("#modalUserImage").attr("src", "uploads/" + userImage);
                $("#chatMessages").html("");
                lastMessageId = 0;

                loadChatModal(userId);

                clearInterval(chatInterval);
                chatInterval = setInterval(() => { loadChatModal(userId); }, 3000);

                // Show modal using Bootstrap API
                let messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();

                // Send message
                $("#modalSendMessage").off("click").on("click", function () {
                    let msg = $("#modalChatMessage").val().trim();
                    if (msg !== "") {
                        $.post("config/sendMessage.php", { id: userId, message: msg }, function (res) {
                            if (res.trim() === "success") {
                                $("#modalChatMessage").val("");
                                loadChatModal(userId);
                            }
                        });
                    }
                });

                // Enter key
                $("#modalChatMessage").off("keydown").on("keydown", function (e) {
                    if (e.key === "Enter" && !e.shiftKey) {
                        e.preventDefault();
                        $("#modalSendMessage").click();
                    }
                });
            });

            // Load chat messages
            function loadChatModal(userId) {
                $.post("config/getChat.php", { id: userId, last_id: lastMessageId }, function (data) {
                    if (data.trim() !== "") {
                        $("#chatMessages").append(data);
                        $("#chatMessages").scrollTop($("#chatMessages")[0].scrollHeight);
                        lastMessageId = $("#chatMessages .message").last().data("id");
                    }
                });
            }

        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("profileModal");
            const closeBtn = document.querySelector(".close");
            const profileData = document.getElementById("profileData");

            // Handle view profile click
            document.querySelectorAll(".view-profile").forEach(btn => {
                btn.addEventListener("click", function () {
                    let userId = this.getAttribute("data-id");
                    profileData.innerHTML = "Loading...";

                    fetch("config/getProfile.php?id=" + userId)
                        .then(res => res.text())
                        .then(data => {
                            profileData.innerHTML = data;
                            modal.style.display = "block";
                        });
                });
            });

            // Close modal
            closeBtn.onclick = function () {
                modal.style.display = "none";
            }
            window.onclick = function (e) {
                if (e.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>