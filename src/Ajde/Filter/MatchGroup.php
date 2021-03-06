<?php


namespace Ajde\Filter;

use Ajde\Filter;
use Ajde\Query;
use Ajde\Filter\Match;
use Ajde\Db\Table;



class MatchGroup extends Filter
{		
	protected $_filters;
	protected $_operator;
	
	public function __construct($operator = Query::OP_AND)
	{
		$this->_operator = $operator;
	}
	
	public function addFilter(Match $filter)
	{
		$this->_filters[] = $filter;
	}
	
	public function prepare(Table $table = null)
	{
		$sqlWhere = '';
		$select = array();
		$first = true;
		$values = array();
		foreach($this->_filters as $filter) {
			$prepared = $filter->prepare($table);
			foreach($prepared as $queryPart => $v) {
				switch ($queryPart) {
					case 'where':
						if ($first === false) {
							$sqlWhere .= ' ' . $v['arguments'][1];
						}
						$sqlWhere .= ' ' . $v['arguments'][0];
						$first = false;
						if (isset($v['values'])) {
							$values = array_merge($values, $v['values']);
						}
						break;
					case 'select':
						$select[] = $v['arguments'][0];
						break;
				}
			}				
		}
		
		return array(
			'where' => array(
				'arguments' => array('(' . $sqlWhere . ')', $this->_operator),
				'values' => $values
			),
			'select' => array(
				'arguments' => array(implode(', ', $select))
			)
		);
	}
}