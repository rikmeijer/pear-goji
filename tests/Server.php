<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

class Server
{
    /**
     * @var resource $httpd
     */
    private $httpd;
    private string $phpBinary;
    private string $bindTo;
    private array $pipes = [];

    public function __construct(string $phpBinary, string $bindTo)
    {
        $this->phpBinary = $phpBinary;
        $url = parse_url($bindTo);
        $this->bindTo = $url['host'] . ':' . $url['port'];
    }

    final public function start(string $root): void
    {
        $arguments = [
            '-S ' . escapeshellarg($this->bindTo),
            '-t ' . escapeshellarg($root . DIRECTORY_SEPARATOR . 'public')
        ];
        $command = escapeshellcmd($this->phpBinary) . ' ' . implode(' ', $arguments);
        $descriptorspec = [
            0 => ["pipe", "r"],
            1 => ["pipe", "a"],
            2 => ["pipe", "a"]
        ];
        $this->httpd = proc_open($command, $descriptorspec, $this->pipes, $root);
    }

    final public function stop(): void
    {
        if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
            $status = proc_get_status($this->httpd);
            exec('taskkill /F /T /PID ' . $status['pid']);
        } else {
            proc_terminate($this->httpd);
        }
        proc_close($this->httpd);
    }
}
