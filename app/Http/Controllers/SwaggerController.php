<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Workout Tracker API",
 *     version="1.0.0",
 *     description="API for managing workouts, exercises, and tracking progress"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class SwaggerController extends Controller
{
    // This file exists only for Swagger annotations
}