<?php

namespace Ehann\RediSearch\Query;

class GetMultiDocumentResult
{
    protected $count;
    protected $documents;

    public function __construct(int $count, array $documents)
    {
        $this->count = $count;
        $this->documents = $documents;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getDocuments(): array
    {
        return $this->documents;
    }


    public static function makeGetMultiDocumentResult(
        array $rawRediSearchResult,
        bool $documentsAsArray,
        bool $noContent = false,
        array $ids
    ) {

        if (!$rawRediSearchResult) {
            return false;
        }

        $count=0;
        $documents = [];
        for ($i = 0; $i < count($rawRediSearchResult); $i++) {
            $document = $documentsAsArray ? [] : new \stdClass();
            $documentsAsArray ?
                $document['id'] = $ids[$i] :
                $document->id = $ids[$i];
            $fields = $rawRediSearchResult[$i];
            if (is_array($fields)) {
                if (!$noContent) {
                    $count++;
                    for ($j = 0; $j < count($fields); $j += 2) {
                        $documentsAsArray ?
                            $document[$fields[$j]] = $fields[$j + 1] :
                            $document->{$fields[$j]} = $fields[$j + 1];
                    }
                }
            }
            $documents[] = $document;
        }
        return new GetMultiDocumentResult($count, $documents);
    }
}
