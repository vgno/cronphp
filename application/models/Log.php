<?php

class Application_Model_Log {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getLog($limit = 20) {
        $sql = 'SELECT * FROM logs ORDER BY logId DESC LIMIT :limit';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function log($jobId, $server, DateTime $start, DateTime $end, $runTime, $response, $output) {
        $sql = 'INSERT INTO logs SET
            logCronjobId = :logCronjobId,
            logServer = :logServer,
            logStart = :logStart,
            logEnd = :logEnd,
            logRunTime = :logRunTime,
            logResponse = :logResponse,
            logOutput = :logOutput';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':logCronjobId', $jobId, PDO::PARAM_INT);
        $stmt->bindValue(':logServer', $server, PDO::PARAM_STR);
        $stmt->bindValue(':logStart', $start->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->bindValue(':logEnd', $end->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->bindValue(':logRunTime', $runTime, PDO::PARAM_STR);
        $stmt->bindValue(':logResponse', $response, PDO::PARAM_STR);
        $stmt->bindValue(':logOutput', $output, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
