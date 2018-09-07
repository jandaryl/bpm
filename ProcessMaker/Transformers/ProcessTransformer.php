<?php

namespace ProcessMaker\Transformers;

use League\Fractal\TransformerAbstract;
use ProcessMaker\Model\Process;

/**
 * Process transformer, used to prepare the JSON response returned in the
 * designer's endpoints.
 *
 * @package ProcessMaker\Transformer
 */
class ProcessTransformer extends TransformerAbstract
{
    /**
     * Transform the process.
     *
     * @param Process $process
     *
     * @return array
     */
    public function transform(Process $process)
    {
        $data = $process->toArray();
        // Now we have the associative array form of process
        // But we need to grab the category and insert it in there if it's defined
        if($data['process_category_id']) {
            // Category is set, let's include the category
            $data['category'] = $data['category']['name'];
        }

        if($data['user_id']) {
            // User is set, let's include the user
            $data['user'] = $data['user']['firstname'] . ' ' . $data['user']['lastname'];
        }
        // Unset category_id, user_id we don't need it anymore
        unset($data['process_category_id'], $data['user_id']);
        
        //Get start events from process definition
        $processes = $process->getDefinitions()->getElementsByTagName('process');
        $data['startPoints'] = [];
        foreach ($processes as $innerProcess) {
            $startEvents = $innerProcess->getElementsByTagName('startEvent');
            foreach ($startEvents as $startEvent) {
                if ($startEvent->getBpmnElementInstance()->getEventDefinitions()->count()===0) {
                    $data['startPoints'][] = [
                        'id' => $startEvent->getAttribute('id'),
                        'name' => $startEvent->getAttribute('name')
                    ];
                }
            }
        }
        return $data;
    }

}