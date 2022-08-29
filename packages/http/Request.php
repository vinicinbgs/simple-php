<?php

namespace Packages\Http;

class Request
{
  public $traceId;

  public function queryParams(string $key): ?string
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }

  public function fields(array $fields = null)
  {
    $data = $this->getInput();

    if (!$fields) {
      return $data;
    }

    $selectedFields = [];

    foreach ($fields as $field) {
      if (isset($data[$field])) {
        $selectedFields[$field] = $data[$field];
      }
    }

    return $selectedFields;
  }

  public function headers(array $params = null)
  {
    $headers = $this->getHeaders();

    if (!$params) {
      return $headers;
    }

    return array_intersect_key($headers, array_flip($params));
  }

  public function getInput()
  {
    $fd = fopen("php://input", "r");
    $data = json_decode(stream_get_contents($fd), true);
    fclose($fd);

    return $data;
  }

  /**
   * @codeCoverageIgnore
   */
  private function getHeaders()
  {
    if (!function_exists('getallheaders')) {
      return $_SERVER;
    }

    return getallheaders();
  }
}
