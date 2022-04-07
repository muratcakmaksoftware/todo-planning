<?php

namespace App\Traits;

use App\Enums\HttpCode\HttpCode;
use App\Enums\Languages\General\GeneralLanguageFile;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait APIResponseTrait
{

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseSuccess(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, Response::HTTP_OK));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseStore(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, HttpCode::STORE));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseUpdate(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, HttpCode::UPDATE));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseDestroy(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, HttpCode::DESTROY));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseRestore(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, HttpCode::RESTORE));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseBadRequest(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_BAD_REQUEST, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, Response::HTTP_BAD_REQUEST));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseUnauthorized(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_UNAUTHORIZED, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, Response::HTTP_UNAUTHORIZED));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseNotFound(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_NOT_FOUND, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, Response::HTTP_NOT_FOUND));
    }

    /**
     * @param array|null $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseInternalServerError(array $attributes = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, $attributes, $message ?? translation(GeneralLanguageFile::HTTP_CODES->value, Response::HTTP_INTERNAL_SERVER_ERROR));
    }

    /**
     * @param int $statusCode
     * @param array|null $attributes
     * @param string $message
     * @return JsonResponse
     */
    public function response(int $statusCode, ?array $attributes, string $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $attributes
        ], $statusCode);
    }
}
