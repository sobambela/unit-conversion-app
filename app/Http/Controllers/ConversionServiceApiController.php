<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RhinoAfrica\UnitConversionObjects\Services\UnitConversionService;
use App\Models\ConversionHistory;

/**
 * ConversionServiceApiController provides acccess to query an API Endpoint for unit conversions
 */
class ConversionServiceApiController
    extends Controller
{
    /**
     * @var UnitConversionService $service
     */
    private UnitConversionService $service;

    /**
     * @param UnitConversionService $service
     */
    public function __construct(UnitConversionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert(Request $request)
    {
        $data = $request->all();
        if (isset($data['from']) && isset($data['to']) && isset($data['value'])) {
            $from = $data['from'];
            $to = $data['to'];
            $value = $data['value'];
            try {
                $this->service->setSourceUnit($from,$value);
                $targetUnit = $this->service->convert($to);
        
                $this->logHistory($from, $to, $value, $targetUnit->getValue());
               
                return response()->json([
                    'error' => false,
                    'message' => 'Request successful. Response OK.',
                    'code' => Response::HTTP_OK,
                    'result' => [
                        'source' => [
                            'value' => $value,
                        ],
                        'target' => [
                            'value' => $targetUnit->getValue(),
                        ]
                    ]
                ],Response::HTTP_OK);
            } catch (\Exception $e) {
                $this->logHistory($from, $to, $value, null,'Fail', $e->getMessage());
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ],$e->getCode());
            }
        }

        return response()->json([
            'error' => true,
            'message' => 'Request failed. Conversion failed.',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function logHistory(
        $from, 
        $to, 
        $value, 
        $toValue, 
        $status = 'Success', 
        $message = 'Success'
    ): void
    {
        ConversionHistory::create([
            'from' => $from,
            'to' => $to,
            'from_value' => $value,
            'to_value' => $toValue,
            'status' => $status,
            'message' => $message,
        ]);
    }
}
