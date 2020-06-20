<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

class Server
{
    private $httpd;
    private string $phpBinary;
    private string $bindTo;

    public function __construct(string $phpBinary, string $bindTo)
    {
        $this->phpBinary = $phpBinary;
        $this->bindTo = $bindTo;
    }

    public function start($root): void
    {
        $command = escapeshellcmd($this->phpBinary) . ' -S ' . escapeshellarg($this->bindTo) . ' -t ' . escapeshellarg($root . DIRECTORY_SEPARATOR . 'public');
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "stdout.txt", "a"),  // stdout is a pipe that the child will write to
            2 => array("file", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "error-output.txt", "a") // stderr is a file to write to
        );
        $this->httpd = proc_open($command, $descriptorspec, $pipes, $root);
    }

    public function stop(): void
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
