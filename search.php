<?php
include("config/init.php");
include("config/database.php");
if (!isset($_SESSION['user_id'])) {
    header('location:auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

    <style>
        /* Previous styles remain the same... */
        #search-container {
            margin-top: 3rem;
        }

        .search-container {
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
            font-size: 3rem;
            margin-bottom: 10px;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            min-width: 300px;
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
            background: linear-gradient(135deg, #fff8f8, #ffe8e8);
            border-bottom: 2px solid #ff6b6b;
        }

        .filters-container.active {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            position: relative;
        }

        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
            font-size: 0.95rem;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
            transform: translateY(-2px);
        }

        .filter-group input::placeholder {
            color: #999;
            font-style: italic;
        }

        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .filter-buttons button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .filter-buttons button.apply {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .filter-buttons button.apply:hover {
            background: linear-gradient(135deg, #ff5252, #ff7979);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .filter-buttons button.reset {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #e9ecef;
        }

        .filter-buttons button.reset:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .results-container {
            padding: 20px;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .results-count {
            font-weight: 600;
            color: #555;
            font-size: 1.1rem;
        }

        .user-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .user-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .user-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .user-image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .user-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .user-card:hover .user-image img {
            transform: scale(1.05);
        }

        .user-info {
            padding: 20px;
        }

        .user-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #ff6b6b;
        }

        .user-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 15px 0;
        }

        .user-detail {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #666;
        }

        .user-detail i {
            color: #ff6b6b;
            width: 16px;
        }

        .match-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .match-actions button {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-view {
            background: #ff6b6b;
            color: white;
        }

        .btn-message {
            background: #f8f9fa;
            color: #495057;
            border: 2px solid #dee2e6;
        }

        .btn-view:hover {
            background: #ff5252;
            transform: translateY(-2px);
        }

        .btn-message:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            gap: 10px;
        }

        .pagination {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            color: #495057;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 45px;
            text-align: center;
        }

        .pagination a:hover {
            background: #ff6b6b;
            color: white;
            border-color: #ff6b6b;
            transform: translateY(-2px);
        }

        .pagination .current {
            background: #ff6b6b;
            color: white;
            border-color: #ff6b6b;
        }

        .pagination .disabled {
            color: #adb5bd;
            cursor: not-allowed;
            background: #f8f9fa;
        }

        .pagination .disabled:hover {
            transform: none;
            background: #f8f9fa;
            color: #adb5bd;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.95rem;
            margin-left: 20px;
        }

        /* Previous modal styles remain the same... */
        .modal-header {
            border: 0px;
            gap: 20px;
        }

        .modal-header>h5 {
            color: #ffffff;
        }

        .modal-body {
            background: linear-gradient(135deg, #ff829dff 0%, rgba(255, 112, 174, 1) 100%);
            border-radius: 20px 20px 0px 0px;
        }

        .modal-footer {
            border-top: 2px solid #ff4093ff;
            background: linear-gradient(135deg, #ff829dff 0%, rgba(255, 112, 174, 1) 100%);
            border-radius: 0px 0px 20px 20px;
        }

        .modal-footer>.btn-send {
            padding: 7px 10px;
            border: 0px;
            border-radius: 5px;
            color: #ffffff;
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

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 22px;
            cursor: pointer;
            color: white;
        }

        /* Chat styles remain the same... */
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

        .message.received>p {
            margin-bottom: 0px;
        }

        .message.sent {
            background-color: #ff1869ff;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
            margin-left: auto;
        }

        .message.sent>p {
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

        .modal-footer button {
            background-color: #ff1869ff;
        }

        @media (max-width: 768px) {
            .search-box {
                flex-direction: column;
                align-items: center;
            }

            .search-box input {
                border-radius: 8px;
                margin-bottom: 10px;
                min-width: 280px;
            }

            .search-box button {
                border-radius: 8px;
                width: 280px;
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

            .user-cards {
                grid-template-columns: 1fr;
            }

            .pagination-container {
                flex-direction: column;
                gap: 15px;
            }

            .pagination-info {
                margin-left: 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <header>
        <?php include 'include/header.php'; ?>
    </header>

    <section>
        <div class="search-container">
            <div class="search-header">
                <h1>Find Your Perfect Match</h1>
                <div class="search-box">
                    <form id="searchForm" style="display: flex;">
                        <input type="text" name="searchQuery" placeholder="Search by name or ID..." id="searchInput">
                        <button type="submit" name="search"><i class="fas fa-search"></i> Search</button>
                    </form>
                </div>
                <div class="search-options">
                    <button type="button" id="toggleFilters"><i class="fas fa-filter"></i> Advanced Filters</button>
                </div>
            </div>

            <div class="filters-container" id="filtersContainer">
                <form id="filterForm">
                    <div class="filter-grid container">
                        <div class="filter-group">
                            <label for="motherTongue"><i class="fas fa-language"></i> Mother Tongue</label>
                            <input type="text" name="motherTongue" id="motherTongue"
                                placeholder="e.g. Hindi, Tamil, English">
                        </div>

                        <div class="filter-group">
                            <label for="income"><i class="fas fa-rupee-sign"></i> Monthly Income</label>
                            <input type="text" name="income" id="income" placeholder="e.g. 20000-50000">
                        </div>

                        <div class="filter-group">
                            <label for="location"><i class="fas fa-map-marker-alt"></i> Location</label>
                            <input type="text" name="location" id="location" placeholder="Enter city or state...">
                        </div>

                        <div class="filter-group">
                            <label for="gender"><i class="fas fa-venus-mars"></i> Gender</label>
                            <select name="gender" id="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Female">Other</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="height"><i class="fas fa-ruler-vertical"></i> Height (cm)</label>
                            <input type="text" name="height" id="height" placeholder="e.g. 150-180">
                        </div>

                        <div class="filter-group">
                            <label for="education"><i class="fas fa-graduation-cap"></i> Education</label>
                            <input type="text" name="education" id="education" placeholder="e.g. Bachelor's, Master's">
                        </div>

                        <div class="filter-group">
                            <label for="age"><i class="fas fa-birthday-cake"></i> Age Range</label>
                            <input type="text" name="age" id="age" placeholder="e.g. 21-30">
                        </div>

                        <div class="filter-group">
                            <label for="profession"><i class="fas fa-briefcase"></i> Profession</label>
                            <input type="text" name="profession" id="profession"
                                placeholder="e.g. Engineer, Doctor, Teacher">
                        </div>

                        <div class="filter-group">
                            <label for="religion"><i class="fas fa-pray"></i> Religion</label>
                            <input type="text" name="religion" id="religion"
                                placeholder="e.g. Hindu, Muslim, Christian">
                        </div>

                        <div class="filter-group">
                            <label for="caste"><i class="fas fa-user"></i> Caste</label>
                            <input type="text" name="caste" id="caste" placeholder="">
                        </div>
                    </div>

                    <div class="filter-buttons">
                        <button type="reset" class="reset"><i class="fas fa-undo"></i> Reset Filters</button>
                        <button type="submit" name="apply-filter" class="apply"><i class="fas fa-search"></i> Apply
                            Filters</button>
                    </div>
                </form>
            </div>

            <div class="results-container container">
                <div class="results-header">
                    <div class="results-count">
                    </div>
                </div>

                <div class="user-cards" id="results">
                    <div class="loading">Loading...</div>
                </div>

                <!-- Pagination -->
                <div id="pagination"></div>

                <!-- Message Modal -->
                <div class="modal fade" id="messageModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img id="modalUserImage" class="chat-user-img">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            let chatInterval;
            let lastMessageId = 0;

            // --- Advanced Filters Toggle ---
            $('#toggleFilters').on('click', function () {
                const filtersContainer = $('#filtersContainer');
                filtersContainer.toggleClass('active');
                if (filtersContainer.hasClass('active')) {
                    $(this).html('<i class="fas fa-times"></i> Hide Filters');
                } else {
                    $(this).html('<i class="fas fa-filter"></i> Advanced Filters');
                }
            });

            // --- Search and Filtering Logic ---
            function loadResults(page) {
                let searchData = $("#searchForm").serialize();
                let filterData = $("#filterForm").serialize();
                let requestData = searchData + "&" + filterData + "&page=" + page;

                $("#results").html('<div class="loading" style="text-align: center; padding: 50px; grid-column: 1 / -1;"><i class="fas fa-spinner fa-spin fa-2x"></i><p>Loading...</p></div>');

                $.ajax({
                    url: "config/search_action.php",
                    type: "GET",
                    data: requestData,
                    dataType: "json",
                    success: function (response) {
                        if (response && response.html) {
                            $("#results").html(response.html);
                            $("#pagination").html(response.pagination);
                            $(".results-count").text(response.totalResults + ' profiles found');
                        } else {
                            $("#results").html('<div class="no-results">Error: Invalid response from server.</div>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        $("#results").html('<div class="no-results" style="text-align: center; padding: 50px; grid-column: 1 / -1;"><h3>An error occurred</h3><p>Could not load results. Please try again.</p></div>');
                    }
                });
            }

            // Initial load
            loadResults(1);

            // Form submissions
            $("#searchForm, #filterForm").on("submit", function (e) {
                e.preventDefault();
                loadResults(1);
            });

            // Reset filters
            $("#filterForm").on("reset", function () {
                setTimeout(() => loadResults(1), 100);
            });

            // Pagination clicks (using event delegation)
            $(document).on("click", "#pagination a", function (e) {
                e.preventDefault();
                let page = $(this).data("page");
                if (page) {
                    loadResults(page);
                }
            });

            // --- Message Modal Logic (using event delegation) ---
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

                let messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();

                $("#modalSendMessage").off("click").on("click", function () {
                    let msg = $("#modalChatMessage").val().trim();
                    if (msg !== "") {
                        $.post("config/sendMessage.php", { id: userId, message: msg }, function (res) {
                            if (res.trim() === "success") {
                                $("#modalChatMessage").val("");
                                loadChatModal(userId, true); // Force scroll to bottom
                            }
                        });
                    }
                });
            });

            function loadChatModal(userId, forceScroll = false) {
                $.post("config/getChat.php", { id: userId, last_id: lastMessageId }, function (data) {
                    if (data.trim() !== "") {
                        $("#chatMessages").append(data);
                        lastMessageId = $("#chatMessages .message").last().data("id") || 0;
                        if (forceScroll) {
                            $("#chatMessages").scrollTop($("#chatMessages")[0].scrollHeight);
                        }
                    }
                });
            }

            // --- View Profile Modal Logic (using event delegation) ---
            const profileModal = $("#profileModal");

            $(document).on("click", ".view-profile", function () {
                let userId = $(this).data("id");
                let profileDataContainer = $("#profileData");

                profileDataContainer.html('<div style="text-align: center; padding: 40px;"><i class="fas fa-spinner fa-spin fa-2x"></i><p>Loading Profile...</p></div>');
                profileModal.show();

                $.get("config/getProfile.php?id=" + userId)
                    .done(function (data) {
                        profileDataContainer.html(data);
                    })
                    .fail(function () {
                        profileDataContainer.html('<div style="text-align: center; padding: 40px; color: #dc3545;"><i class="fas fa-exclamation-triangle fa-2x"></i><p>Error loading profile. Please try again.</p></div>');
                    });
            });

            // Close the profile modal
            profileModal.on('click', function (e) {
                if ($(e.target).is(profileModal) || $(e.target).hasClass('close')) {
                    profileModal.hide();
                }
            });
        });
    </script>
</body>

</html>