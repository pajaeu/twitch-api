<?php

namespace Twitch;

class TwitchConfig
{

	public const AUTHURL = 'https://id.twitch.tv/oauth2/authorize';
	public const TOKENURL = 'https://id.twitch.tv/oauth2/token';

	public const APIURL = 'https://api.twitch.tv/helix/';

	protected string $clientId;
	protected string $clientSecret;
	protected string $returnUri;
	protected array $scope = [];

	public function __construct(
		string $clientId,
		string $clientSecret,
		string $returnUri,
		array $scope = []
	)
	{
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->returnUri = $returnUri;

		if (!empty($scope)){
			foreach($scope as $value){
				$this->scope[] = $value;
			}
		}
	}


	public function getClientId(): string
	{
		return $this->clientId;
	}


	public function getClientSecret(): string
	{
		return $this->clientSecret;
	}


	public function getScope(): array
	{
		return $this->scope;
	}


	public function getReturnUri(): string
	{
		return $this->returnUri;
	}

}