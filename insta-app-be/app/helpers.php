<?php

if (!function_exists('apiResponse')) {
    /**
     * @param  string  $message
     * @param  int  $statusCode
     * @param  array<string, mixed>  $data
     * @return \Illuminate\Http\JsonResponse
     */
    function apiResponse($data = null, string $message = 'Request successful', int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        $returnables = [
            'message' => $message,
        ];

        if ($data) $returnables['data'] = $data;

        return response()->json($returnables, $statusCode);
    }
}

if (!function_exists('apiErrorResponse')) {
    /**
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    function apiErrorResponse(string $message, int $statusCode = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}

if (!function_exists('apiPaginationResponse')) {
    /**
     * @param  \Illuminate\Pagination\LengthAwarePaginator  $paginator
     * @return array<string, mixed>
     */
    function apiPaginationResponse(\Illuminate\Pagination\LengthAwarePaginator $paginator): array
    {
        return [
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
            'data' => $paginator->items(),
        ];
    }
}