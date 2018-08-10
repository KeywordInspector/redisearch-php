<?php

namespace Ehann\RediSearch\Query;


class GetDocumentResult
{
    protected $document;

    public function __construct(array $document)
    {
        $this->document = $document;
    }

    public function getDocument(): array
    {
        return $this->document;
    }


    public static function makeGetDocumentResult(
        array $rawRediSearchResult,
        bool $documentsAsArray,
        bool $noContent = false,
        $id
    ) {

        if (!$rawRediSearchResult) {
            return false;
        }

        if (count($rawRediSearchResult) === 1) {
            return new GetDocumentResult(null);
        }

        $document = $documentsAsArray ? [] : new \stdClass();
        $documentsAsArray ?
            $document['id'] = $id :
            $document->id = $id;
        if (!$noContent) {
            if (is_array($rawRediSearchResult)) {
                for ($j = 0; $j < count($rawRediSearchResult); $j ++) {
                    $documentsAsArray ?
                        $document[$rawRediSearchResult[$j]] = $rawRediSearchResult[$j] :
                        $document->{$rawRediSearchResult[$j]} = $rawRediSearchResult[$j];
                }
            }
        }
        return new GetDocumentResult([$document]);
    }
}
