<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 13/10/15
 * Time: 09:57
 */

namespace Sopra\Logger;


use Psr\Log\AbstractLogger;

class PDOLogger extends AbstractLogger
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * PDOLogger constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $sql = "INSERT INTO log (date_log, level, message) VALUES (NOW(), :level, :message)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('level', $level);
        $stmt->bindValue('message', $message);

        $stmt->execute();
    }
}