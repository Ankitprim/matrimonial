<?php

include("init.php");
include("database.php");

$obj = new query;

$resultsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $resultsPerPage;

// Collect filters
$searchQuery   = $_GET['searchQuery']   ?? null;
$motherTongue  = $_GET['motherTongue']  ?? null;
$income        = $_GET['income']        ?? null;
$location      = $_GET['location']      ?? null;
$gender        = $_GET['gender']        ?? null;
$height        = $_GET['height']        ?? null;
$education     = $_GET['education']     ?? null;
$age           = $_GET['age']           ?? null;
$maritalStatus = $_GET['maritalStatus'] ?? null;
$profession    = $_GET['profession']    ?? null;
$religion      = $_GET['religion']      ?? null;
$caste         = $_GET['caste']         ?? null;

if ($searchQuery) {
    // Basic search
    $result = $obj->getSearch($searchQuery, $resultsPerPage, $offset);
    $totalResults = $obj->getSearchCount($searchQuery);
} else {
    // Advanced search with all filters - fixed parameter order
    $result = $obj->advancedSearch($motherTongue, $income, $location, $gender, $height, $education, $age, $profession, $religion, $caste, $resultsPerPage, $offset);

    $totalResults = $obj->getAdvancedSearchCount(
        $motherTongue, $income, $location, $gender, $height, $education,
        $age, $profession, $religion, $caste
    );
}

// Build results HTML
$html = "";
if ($result && count($result) > 0) {
    foreach ($result as $data) {
        // Fixed string concatenation and proper escaping
        $html .= '<div class="user-card">
                    <div class="user-image">
                        <img src="uploads/' . htmlspecialchars($data['image']) . '" 
                             alt="' . htmlspecialchars($data['full_name']) . '">
                    </div>
                    <div class="user-info">
                        <h3 class="user-name">' . htmlspecialchars($data['full_name']) . '</h3>
                        <div class="user-details">
                            <div class="user-detail">
                                <i class="fas fa-birthday-cake"></i>
                                ' . htmlspecialchars($data['age']) . ' years
                            </div>
                            <div class="user-detail">
                                <i class="fas fa-ruler-vertical"></i>
                                ' . htmlspecialchars($data['height']) . ' cm
                            </div>
                            <div class="user-detail">
                                <i class="fas fa-language"></i>
                                ' . htmlspecialchars($data['motherTongue']) . '
                            </div>
                            <div class="user-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                ' . htmlspecialchars($data['location']) . '
                            </div>
                        </div>
                        <div class="match-actions">
                            <button class="btn btn-primary openMessagePopup"
                                data-id="' . htmlspecialchars($data['user_id']) . '"
                                data-name="' . htmlspecialchars($data['full_name']) . '"
                                data-image="' . htmlspecialchars($data['image']) . '">
                                <i class="fas fa-comment"></i> Message
                            </button>
                            <button class="btn btn-secondary view-profile"
                                data-id="' . htmlspecialchars($data['user_id']) . '">
                                <i class="fas fa-user"></i> View Profile
                            </button>
                        </div>
                    </div>
                </div>';
    }
} else {
    $html = "<p>No result found</p>";
}

// Build pagination with proper validation
$totalPages = $totalResults > 0 ? ceil($totalResults / $resultsPerPage) : 0;
$pagination = '<div class="pagination">';

if ($totalPages > 1) {
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? ' class="active"' : '';
        $pagination .= '<a href="#" data-page="' . $i . '"' . $active . '>' . $i . '</a> ';
    }
}

$pagination .= '</div>';

// Set proper content type and return JSON
header('Content-Type: application/json');
echo json_encode([
    "html" => $html, 
    "pagination" => $pagination,
    "totalResults" => $totalResults,
    "currentPage" => $page,
    "totalPages" => $totalPages
]);

?>