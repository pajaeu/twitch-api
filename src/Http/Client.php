<?php

namespace Twitch\Http;

class Client
{

	protected int $status;
	protected string $errorMessage;
	protected string $response;
	protected array $headers = [];
	protected array $parameters = [];


	public function request(string $url, string $method = 'GET', array $parameters = [], array $headers = []): Client
	{
		$ch = curl_init();

		$options = [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => 1
		];

		if (strtoupper($method) === 'POST')
			$options[CURLOPT_POST] = true;

		if (!empty($parameters)) {
			$options[CURLOPT_POSTFIELDS] = $parameters;
			$this->parameters = $parameters;
		}

		if (!empty($headers)){
			foreach($headers as $key => $value){
				$options[CURLOPT_HTTPHEADER][] = sprintf('%s: %s', $key, $value);
				$this->headers[] = sprintf('%s: %s', $key, $value);
			}
		}

		curl_setopt_array($ch, $options);

		$output = curl_exec($ch);

		$this->status = http_response_code();
		$this->errorMessage = curl_error($ch);

		$response = json_decode($output);

		if (isset($response->status)){
			$this->status = (int) $response->status;
			$this->errorMessage = $response->message;
		}

		curl_close($ch);

		$this->response = $output;

		return $this;
	}


	public function getResponse(): object
	{
		return json_decode($this->response);
	}


	public function getParameters(): array
	{
		return $this->parameters;
	}


	public function getStatusMessage(): string
	{
		return $this->errorMessage;
	}


	public function getStatusCode(): int
	{
		return $this->status;
	}


	public function getHeaders(): array
	{
		return $this->headers;
	}

}