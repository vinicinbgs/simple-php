<?php

namespace Packages\Http;

class Request
{

  public function queryParams(string $key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }

  public function fields(array $fields = null)
  {
    $fd = fopen("php://input", "r");
    $data = json_decode(stream_get_contents($fd), true);
    fclose($fd);

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
    $headers = getallheaders();

    if (!$params) {
      return $headers;
    }

    return array_intersect_key($headers, array_flip($params));
  }
}
