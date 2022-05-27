<?php
class Conf
{
    private \SimpleXMLElement $xml;
    private \SimpleXMLElement $lastmatch;

    public function __construct(private string $file)
    {
        if (!file_exists($this->file)){
            throw new \Exception("File {'$file'} is not exixts");
        }
        $this->xml = simplexml_load_file($this->file);
    }

    public function write(): void
    {
        if (!is_writable($this->file)){
            throw new \Exception("file $this->file is not writeable");
        }
        print "File $this->file is apparently writeable<br>";
        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get(string $str): ?string
    {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)){
            $this->lastmatch = $matches[0];
            return (string) $matches[0];
        }
        return null;
    }

    public function set(string $key, string $value): void
    {
        if (!is_null($this->get($key))){
            $this->lastmatch[] = $value;
            return;
        }
        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);

    }
}

try {
    $conf = new Conf("conf01.xml");
    print "User: ". $conf->get("user")."<br>";
    print "Host: ". $conf->get("host")."<br>";
    $conf->set("pass", "newpass");
    $conf->write();
} catch (\Exception $e){
    print $e->getMessage();
}