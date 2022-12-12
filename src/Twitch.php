<?php

namespace Twitch;

use Twitch\Auth\AuthApi;
use Twitch\Http\Client;

class Twitch
{

	private TwitchConfig $config;
	private Client $client;
	private AuthApi $authApi;


	public function __construct(
		TwitchConfig $config
	)
	{
		$this->config = $config;
		$this->client = new Client();
		$this->authApi = new AuthApi($this->config, $this->client);
	}


	public function getAuthApi(): AuthApi
	{
		return $this->authApi;
	}


	public function getUserByToken(string $token): string|object
	{
		$request = $this->client->request(
			TwitchConfig::APIURL . 'users',
			'GET',
			[],
			[
				'Authorization' => 'Bearer ' . $token,
				'Client-Id' => $this->config->getClientId()
			]
		);

		$response = $request->getResponse();

		if ($request->getStatusCode() !== 200)
			return 'Unauthorized';

		return $response->data[0];
	}

}