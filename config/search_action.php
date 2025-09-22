<?php
// **FIX**: Start output buffering to catch any stray warnings or notices
ob_start();

include("init.php");
include("database.php");

$obj = new query;

$resultsPerPage = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $resultsPerPage;

// Collect and clean filters
$searchQuery   = !empty($_GET['searchQuery']) ? trim($_GET['searchQuery']) : null;
$motherTongue  = !empty($_GET['motherTongue']) ? trim($_GET['motherTongue']) : null;
$income        = !empty($_GET['income']) ? trim($_GET['income']) : null;
$location      = !empty($_GET['location']) ? trim($_GET['location']) : null;
$gender        = !empty($_GET['gender']) ? trim($_GET['gender']) : null;
$height        = !empty($_GET['height']) ? trim($_GET['height']) : null;
$education     = !empty($_GET['education']) ? trim($_GET['education']) : null;
$age           = !empty($_GET['age']) ? trim($_GET['age']) : null;
$maritalStatus = !empty($_GET['maritalStatus']) ? trim($_GET['maritalStatus']) : null;
$profession    = !empty($_GET['profession']) ? trim($_GET['profession']) : null;
$religion      = !empty($_GET['religion']) ? trim($_GET['religion']) : null;
$caste         = !empty($_GET['caste']) ? trim($_GET['caste']) : null;

$hasAdvancedFilters = $motherTongue || $income || $location || $gender || $height ||
                     $education || $age || $maritalStatus || $profession || $religion || $caste;

if ($searchQuery && !$hasAdvancedFilters) {
    // Pure basic search
    $result = $obj->getSearch($searchQuery, $resultsPerPage, $offset);
    $totalResults = $obj->getSearchCount($searchQuery);
} else {
    // Advanced search
    $filters = [];
    if ($searchQuery) $filters['searchQuery'] = $searchQuery;
    if ($motherTongue) $filters['motherTongue'] = $motherTongue;
    if ($income) $filters['income'] = $income;
    if ($location) $filters['location'] = $location;
    if ($gender) $filters['gender'] = $gender;
    if ($height) $filters['height'] = $height;
    if ($education) $filters['education'] = $education;
    if ($age) $filters['age'] = $age;
    if ($maritalStatus) $filters['maritalStatus'] = $maritalStatus;
    if ($profession) $filters['profession'] = $profession;
    if ($religion) $filters['religion'] = $religion;
    if ($caste) $filters['caste'] = $caste;
    
    $result = $obj->advancedSearch($filters, $resultsPerPage, $offset);
    $totalResults = $obj->getAdvancedSearchCount($filters);
}

// Build results HTML
$html = "";
if (!empty($result)) {
    foreach ($result as $data) {
        $userData = array_merge([
            'image' => 'default.png',
            'full_name' => 'Unknown',
            'age' => 'N/A',
            'height' => 'N/A',
            'motherTongue' => 'N/A',
            'location' => 'N/A',
            'user_id' => 0
        ], $data);
        
        // The rest of your HTML generation logic remains the same...
        $html .= '<div class="user-card">
                    <div class="user-image">
                        <img src="uploads/' . htmlspecialchars($userData['image']) . '" 
                             alt="' . htmlspecialchars($userData['full_name']) . '">
                    </div>
                    <div class="user-info">
                        <h3 class="user-name">' . htmlspecialchars($userData['full_name']) . '</h3>
                        <div class="user-details">
                            <div class="user-detail"><i class="fas fa-birthday-cake"></i> ' . htmlspecialchars($userData['age']) . ' years</div>
                            <div class="user-detail"><i class="fas fa-ruler-vertical"></i> ' . htmlspecialchars($userData['height']) . ' cm</div>
                            <div class="user-detail"><i class="fas fa-language"></i> ' . htmlspecialchars($userData['motherTongue']) . '</div>
                            <div class="user-detail"><i class="fas fa-map-marker-alt"></i> ' . htmlspecialchars($userData['location']) . '</div>
                        </div>
                        <div class="match-actions">
                            <button class="btn btn-primary openMessagePopup" data-id="' . htmlspecialchars($userData['user_id']) . '" data-name="' . htmlspecialchars($userData['full_name']) . '" data-image="' . htmlspecialchars($userData['image']) . '"><i class="fas fa-comment"></i> Message</button>
                            <button class="btn btn-secondary view-profile" data-id="' . htmlspecialchars($userData['user_id']) . '"><i class="fas fa-user"></i> View Profile</button>
                        </div>
                    </div>
                </div>';
    }
} else {
    $html = '<div class="no-results" style="text-align: center; padding: 50px; grid-column: 1 / -1;">
                <i class="fas fa-search" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                <h3>No profiles found</h3>
                <p>Try adjusting your search criteria or filters</p>
             </div>';
}

// Build pagination
$totalPages = $totalResults > 0 ? ceil($totalResults / $resultsPerPage) : 0;
$pagination = '';
if ($totalPages > 1) {
    // Your pagination logic remains the same...
    $pagination .= '<div class="pagination-container"><div class="pagination">';
    if ($page > 1) {
        $pagination .= '<a href="#" data-page="' . ($page - 1) . '" class="prev"><i class="fas fa-chevron-left"></i> Previous</a>';
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? ' class="current"' : '';
        $pagination .= '<a href="#" data-page="' . $i . '"' . $active . '>' . $i . '</a>';
    }
    if ($page < $totalPages) {
        $pagination .= '<a href="#" data-page="' . ($page + 1) . '" class="next">Next <i class="fas fa-chevron-right"></i></a>';
    }
    $pagination .= '</div></div>';
}

$response = [
    "html" => $html, 
    "pagination" => $pagination,
    "totalResults" => (int)$totalResults
];

// **FIX**: Clean the output buffer before sending the final JSON
$jsonResponse = json_encode($response, JSON_UNESCAPED_UNICODE);
ob_end_clean();

header('Content-Type: application/json');
echo $jsonResponse;

?>