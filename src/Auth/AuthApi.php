<?php

namespace Twitch\Auth;

use Twitch\Exceptions\BadRequest;
use Twitch\Http\Client;
use Twitch\TwitchConfig;

class AuthApi
{

	private TwitchConfig $config;
	private Client $client;


	public function __construct(
		TwitchConfig $config,
		Client $client
	)
	{
		$this->config = $config;
		$this->client = $client;
	}


	public function getAuthUrl(): string
	{
		$params = [
			'client_id' => $this->config->getClientId(),
			'redirect_uri' => $this->config->getReturnUri(),
			'response_type' => 'code',
			'scope' => implode(' ', $this->config->getScope())
		];

		return TwitchConfig::AUTHURL . '?' . http_build_query($params);
	}


	/**
	 * @return string
	 * @throws BadRequest
	 */
	public function getUserToken(): string
	{
		$code = $_GET['code'];

		$params = [
			'client_id' => $this->config->getClientId(),
			'client_secret' => $this->config->getClientSecret(),
			'code' => $code,
			'grant_type' => 'authorization_code',
			'redirect_uri' => $this->config->getReturnUri(),
		];

		$request = $this->client->request(
			TwitchConfig::TOKENURL,
			'POST',
			$params
		);
		$response = $request->getResponse();

		if ($request->getStatusCode() !== 200)
			throw new BadRequest($request->getStatusMessage());

		return $response->access_token;
	}

}