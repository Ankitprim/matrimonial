<?php

class Database
{
    private $host = "localhost";
    private $db_name = "shadivivah";
    private $user = "root";
    private $password = "";

    protected function connect()
    {
        $conn = null;

        try {
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $conn;
    }
}

class query extends Database
{
    public function getData($table, $fields = '*', $conditionArr)
    {
        $condition = "";
        foreach ($conditionArr as $key => $value) {
            $condition .= "$key = :$key AND ";
        }
        $condition = rtrim($condition, " AND ");
        $sql = "SELECT $fields FROM $table WHERE $condition";
        $stmt = $this->connect()->prepare($sql);
        foreach ($conditionArr as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt;
    }

    public function insertData($table, $data)
    {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->connect()->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }
    public function updateData($table, $data, $conditionArr)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ", ");
        $condition = "";
        foreach ($conditionArr as $key => $value) {
            $condition .= "$key = :cond_$key AND ";
        }
        $condition = rtrim($condition, " AND ");
        $sql = "UPDATE $table SET $set WHERE $condition";
        $stmt = $this->connect()->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        foreach ($conditionArr as $key => $value) {
            $stmt->bindValue(":cond_$key", $value);
        }
        return $stmt->execute();

    }

    public function deleteData($table, $conditionArr)
    {
        $condition = "";
        foreach ($conditionArr as $key => $value) {
            $condition .= "$key = :$key AND ";
        }
        $condition = rtrim($condition, " AND ");
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->connect()->prepare($sql);
        foreach ($conditionArr as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    public function searchData($table, $searchArr, $fields = '*')
    {
        $condition = "";
        foreach ($searchArr as $key => $value) {
            $condition .= "$key LIKE :$key OR ";
        }
        $condition = rtrim($condition, " OR ");
        $sql = "SELECT $fields FROM $table WHERE $condition";
        $stmt = $this->connect()->prepare($sql);
        foreach ($searchArr as $key => $value) {
            $stmt->bindValue(":$key", "%$value%");
        }
        $stmt->execute();
        return $stmt;
    }

    public function getMatches($userId, $limit = 50, $offset = 0, $debug = false)
    {
        $sql = "
        SELECT DISTINCT 
            p.profile_id,
            u.user_id,
            u.full_name,
            u.age,
            u.dob,
            u.gender,
            p.height,
            p.religion,
            p.caste,
            p.motherTongue,
            p.education,
            p.profession,
            p.location,
            p.aboutMe,
            p.image,
            p.lookingFor
        FROM profiles p
        JOIN users u ON p.user_id = u.user_id
        LEFT JOIN preferences pref ON pref.user_id = :user_id
        WHERE 
            p.user_id != :user_id

            /* Age range */
            AND (
                pref.ageRange IS NULL OR TRIM(pref.ageRange) = '' OR LOWER(pref.ageRange) = 'n/a'
                OR (
                    (COALESCE(NULLIF(u.age,0), TIMESTAMPDIFF(YEAR,u.dob,CURDATE())))
                    BETWEEN 
                    CAST(SUBSTRING_INDEX(pref.ageRange,'-',1) AS UNSIGNED)
                    AND CAST(SUBSTRING_INDEX(pref.ageRange,'-',-1) AS UNSIGNED)
                )
            )

            /* Height range */
            AND (
                pref.heightRange IS NULL OR TRIM(pref.heightRange) = '' OR LOWER(pref.heightRange) = 'n/a'
                OR (
                CAST(p.height AS DECIMAL(8,2))
                BETWEEN CAST(SUBSTRING_INDEX(pref.heightRange,'-',1) AS DECIMAL(8,2))
                        AND CAST(SUBSTRING_INDEX(pref.heightRange,'-',-1) AS DECIMAL(8,2))
                )
            )

            /* Religion (RELAXED with REGEXP) */
            AND (
                pref.religionPrefer IS NULL OR TRIM(pref.religionPrefer) = '' OR LOWER(pref.religionPrefer) = 'n/a'
                OR LOWER(p.religion) REGEXP REPLACE(LOWER(pref.religionPrefer), ',', '|')
            )

            /* Caste (RELAXED with REGEXP) */
            AND (
                pref.castePrefer IS NULL OR TRIM(pref.castePrefer) = '' OR LOWER(pref.castePrefer) = 'n/a'
                OR LOWER(p.caste) REGEXP REPLACE(LOWER(pref.castePrefer), ',', '|')
            )

            /* Gender (strict) */
            AND (
                pref.genderPrefer IS NULL OR TRIM(pref.genderPrefer) = '' OR LOWER(pref.genderPrefer) = 'n/a'
                OR FIND_IN_SET(u.gender, pref.genderPrefer) > 0
            )

            /* Mother Tongue (RELAXED with REGEXP) */
            AND (
                pref.motherTonguePrefer IS NULL OR TRIM(pref.motherTonguePrefer) = '' OR LOWER(pref.motherTonguePrefer) = 'n/a'
                OR LOWER(p.motherTongue) REGEXP REPLACE(LOWER(pref.motherTonguePrefer), ',', '|')
            )

            /* Education (RELAXED with REGEXP) 
            AND (
                pref.educationPrefer IS NULL OR TRIM(pref.educationPrefer) = '' OR LOWER(pref.educationPrefer) = 'n/a'
                OR LOWER(p.education) REGEXP REPLACE(LOWER(pref.educationPrefer), ',', '|')
            )*/

            /* Profession (RELAXED with REGEXP) 
            AND (
                pref.professionPrefer IS NULL OR TRIM(pref.professionPrefer) = '' OR LOWER(pref.professionPrefer) = 'n/a'
                OR LOWER(p.profession) REGEXP REPLACE(LOWER(pref.professionPrefer), ',', '|')
            )*/

            /* Location (RELAXED with REGEXP) */
            AND (
                pref.locationPrefer IS NULL OR TRIM(pref.locationPrefer) = '' OR LOWER(pref.locationPrefer) = 'n/a'
                OR LOWER(p.location) REGEXP REPLACE(LOWER(pref.locationPrefer), ',', '|')
            )

        ORDER BY u.full_name
        LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        // if ($debug) {
        //     echo "<pre>";
        //     echo "SQL:\n" . $sql . "\n\n";
        //     echo "Params:\n";
        //     var_dump([
        //         ':user_id' => $userId,
        //         ':limit'   => $limit,
        //         ':offset'  => $offset
        //     ]);
        //     echo "</pre>";
        // }

        $stmt->execute();
        return $stmt;
    }
    
    public function blockUser($blocker_id, $blocked_id)
    {
        try {
            $sql = "INSERT IGNORE INTO blocked_users (blocker_id, blocked_id)
                VALUES (:blocker_id, :blocked_id)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                ':blocker_id' => $blocker_id,
                ':blocked_id' => $blocked_id
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Block Error: " . $e->getMessage();
            return false;
        }
    }

    public function canSendMessage($sender_id, $receiver_id)
    {
        $sql = "SELECT 1 FROM blocked_users 
            WHERE (blocker_id = :receiver_id AND blocked_id = :sender_id)
               OR (blocker_id = :sender_id AND blocked_id = :receiver_id)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            ':sender_id' => $sender_id,
            ':receiver_id' => $receiver_id
        ]);
        return $stmt->rowCount() === 0; // true if no block exists
    }


    public function getUserConversations($user_id)
    {
        $sql = "SELECT 
                u.user_id,
                u.full_name,
                p.image,
                m.message,
                m.created_at
            FROM messages m
            JOIN users u 
                ON u.user_id = CASE 
                    WHEN m.sender_id = :user_id THEN m.receiver_id
                    ELSE m.sender_id
                END
            JOIN profiles p 
                ON u.user_id = p.user_id
            WHERE (m.sender_id = :user_id OR m.receiver_id = :user_id)
            AND m.id IN (
                SELECT MAX(id)
                FROM messages
                WHERE sender_id = :user_id OR receiver_id = :user_id
                GROUP BY CASE WHEN sender_id = :user_id THEN receiver_id ELSE sender_id END
            )
            ORDER BY m.created_at DESC";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessages($myId, $otherId)
    {
        $sql = "SELECT * FROM messages 
            WHERE (sender_id = :myId AND receiver_id = :otherId) 
               OR (sender_id = :otherId AND receiver_id = :myId)
            ORDER BY created_at ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            ':myId' => $myId,
            ':otherId' => $otherId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessagesAfter($myId, $otherId, $lastId)
    {
        $sql = "SELECT * FROM messages 
            WHERE ((sender_id = :myId AND receiver_id = :otherId) 
               OR (sender_id = :otherId AND receiver_id = :myId))
              AND id > :lastId
            ORDER BY created_at ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            ':myId' => $myId,
            ':otherId' => $otherId,
            ':lastId' => $lastId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendMessages($myId, $otherId, $message)
    {
        $sql = "INSERT INTO messages (sender_id, receiver_id, message, created_at) 
        VALUES (:myId, :otherId, :message, NOW())";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['myId' => $myId, 'otherId' => $otherId, 'message' => $message]);
        return $stmt;
    }

    public function getProfile($user_id)
    {

        $sql = "SELECT u.user_id,u.gender, u.full_name, p.image, p.height, p.religion, p.caste, 
               p.motherTongue, p.education, p.profession, p.location, 
               p.aboutMe, p.lookingFor
        FROM users u
        JOIN profiles p ON u.user_id = p.user_id
        WHERE u.user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        return $profile;
    }

    public function getSearch($keyword)
    {
        try {
            $sql = "SELECT 
        u.user_id,
        u.full_name,
        u.age,
        p.image,
        p.height,
        p.motherTongue,
        p.location FROM users u LEFT JOIN profiles p ON u.user_id = p.user_id
        WHERE u.user_id = :keyword OR u.full_name LIKE :search_name;
        ";

            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(':keyword', $keyword, PDO::PARAM_INT);
            $stmt->bindValue(':search_name', "%$keyword%", PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Search Error", $e->getMessage();
            return [];
        }
    }


}



?>