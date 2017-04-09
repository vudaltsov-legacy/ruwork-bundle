<?php

namespace Ruwork\CoreBundle\Monolog\Processor;

use Symfony\Component\HttpFoundation\RequestStack;

class RequestProcessor
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param array $record
     *
     * @return array
     */
    public function processRecord(array $record)
    {
        $request = $this->requestStack->getCurrentRequest();

        if ($request) {
            $record['extra']['server'] = $request->server->all();
            $record['extra']['query'] = $request->query->all();
            $record['extra']['request'] = $request->request->all();
            $record['extra']['xml_http_request'] = $request->isXmlHttpRequest() ? 'true' : 'false';
        }

        return $record;
    }
}
