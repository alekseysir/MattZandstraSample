<?php
class Conf
{
    private \SimpleXMLElement $xml;
    private \SimpleXMLElement $lastmatch;

    public function __construct(private string $file)
    {
        $this->xml = simplexml_load_file($this->file);
    }

    public function write(): void
    {
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