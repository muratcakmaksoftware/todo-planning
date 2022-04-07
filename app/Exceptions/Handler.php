<?php

namespace App\Exceptions;

use App\Enums\Languages\General\GeneralLanguageFile;
use App\Traits\APIResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use APIResponseTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

            if($e instanceof ValidationException){
                return $this->responseBadRequest($e->validator->getMessageBag()->toArray());
            }

            if($e instanceof ModelNotFoundException){
                return $this->responseInternalServerError(null, translation(GeneralLanguageFile::EXCEPTION, 'ModelNotFoundException', ['model' => Str::afterLast($e->getModel(), '\\')]));
            }

            if($e instanceof Exception){
                return $this->responseBadRequest(); //error hiding
            }

        });
    }
}
