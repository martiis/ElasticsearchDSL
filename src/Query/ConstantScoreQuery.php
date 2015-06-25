<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Query;

use ONGR\ElasticsearchDSL\BuilderInterface;
use ONGR\ElasticsearchDSL\DslTypeAwareTrait;
use ONGR\ElasticsearchDSL\ParametersTrait;

/**
 * Constant score query class.
 */
class ConstantScoreQuery implements BuilderInterface
{
    use ParametersTrait;
    use DslTypeAwareTrait;

    /**
     * @var BuilderInterface
     */
    private $query;

    /**
     * @param BuilderInterface $query
     * @param array            $parameters
     */
    public function __construct(BuilderInterface $query, array $parameters = [])
    {
        $this->query = $query;
        $this->setParameters($parameters);
        $this->setDslType('query');
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'constant_score';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $query = [
            strtolower($this->getDslType()) => [
                $this->query->getType() => $this->query->toArray(),
            ],
        ];

        $output = $this->processArray($query);

        return $output;
    }
}
