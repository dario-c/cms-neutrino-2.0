<?php namespace Neutrino\Components;
	
interface ComponentContract {
	
	public function fields($fieldName);
    public function process($fieldName, array $requestParameters);
    public function rules($fieldName, array $requestParamters, array $parameters = array());
		
}