<?php

class HomepageSection
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /** Fetch all sections (admin) */
    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM homepage_sections
            ORDER BY position ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Fetch active sections (frontend) */
    public function allActive(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM homepage_sections
            WHERE is_active = 1
            ORDER BY position ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Find section by ID */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM homepage_sections
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    /** Create section */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO homepage_sections
                (title, type, position, is_active)
            VALUES
                (:title, :type, :position, :is_active)
        ");

        return $stmt->execute([
            'title'     => $data['title'],
            'type'      => $data['type'],
            'position'  => $data['position'],
            'is_active' => $data['is_active']
        ]);
    }

    /** Update section */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE homepage_sections
            SET
                title = :title,
                type = :type,
                position = :position,
                is_active = :is_active
            WHERE id = :id
        ");

        return $stmt->execute([
            'title'     => $data['title'],
            'type'      => $data['type'],
            'position'  => $data['position'],
            'is_active' => $data['is_active'],
            'id'        => $id
        ]);
    }

    /** Delete section */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM homepage_sections
            WHERE id = :id
        ");

        return $stmt->execute(['id' => $id]);
    }

    /** Get movie IDs assigned to a section */
    public function getSectionMovies(int $sectionId): array
    {
        $stmt = $this->db->prepare("
            SELECT movie_id
            FROM homepage_section_movies
            WHERE section_id = :sid
            ORDER BY position ASC
        ");

        $stmt->execute(['sid' => $sectionId]);

        return array_column(
            $stmt->fetchAll(PDO::FETCH_ASSOC),
            'movie_id'
        );
    }

    public function getNextPosition(): int
    {
        $stmt = $this->db->query("
            SELECT COALESCE(MAX(position), 0) + 1 AS next_pos
            FROM homepage_sections
        ");

        return (int)$stmt->fetchColumn();
    }


    /** Sync movies for a section (delete + insert) */
    public function syncMovies(int $sectionId, array $movieIds): void
    {
        // Remove old
        $this->db->prepare("
            DELETE FROM homepage_section_movies
            WHERE section_id = :sid
        ")->execute(['sid' => $sectionId]);

        if (empty($movieIds)) {
            return;
        }

        // Insert new
        $stmt = $this->db->prepare("
            INSERT INTO homepage_section_movies
                (section_id, movie_id, position)
            VALUES
                (:sid, :mid, :pos)
        ");

        foreach ($movieIds as $index => $movieId) {
            $stmt->execute([
                'sid' => $sectionId,
                'mid' => (int)$movieId,
                'pos' => $index + 1
            ]);
        }
    }
    public function reorder(array $rows): void
    {
        $stmt = $this->db->prepare("
            UPDATE homepage_sections
            SET position = :position
            WHERE id = :id
        ");

        foreach ($rows as $row) {
            $stmt->execute([
                'position' => (int)$row['position'],
                'id'       => (int)$row['id']
            ]);
        }
    }

}
