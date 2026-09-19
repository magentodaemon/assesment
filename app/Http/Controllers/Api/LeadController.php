<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\LeadResource;
use App\Models\Lead;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LeadController extends Controller
{
    /**
     * GET /leads
     *
     * Query params (per API docs):
     *   page, limit                              -> pagination
     *   q                                        -> free-text search
     *   first_name, last_name, company_name,
     *   position_title, location, email_status,
     *   country_code, industry_name,
     *   position_location, persona, gender       -> exact-match filters
     *
     * Headers: Authorization / X-API-Token       -> handled by VerifyApiToken middleware
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $token = $request->bearerToken();
       
        if (! $token ||  config('services.leads.token') != $token) {
            abort(401, 'Unauthorized.');
        }

        $filters = $request->validate([
            'p' => ['sometimes', 'integer', 'min:1'],
            'limit' => ['sometimes', 'integer', 'min:1', 'max:500'],
            'q' => ['sometimes', 'string', 'max:255'],
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'company_name' => ['sometimes', 'string', 'max:255'],
            'position_title' => ['sometimes', 'string', 'max:255'],
            'location' => ['sometimes', 'string', 'max:255'],
            'email_status' => ['sometimes', 'string', 'max:255'],
            'country_code' => ['sometimes', 'string', 'max:4'],
            'industry_name' => ['sometimes', 'string', 'max:255'],
            'position_location' => ['sometimes', 'string', 'max:255'],
            'persona' => ['sometimes', 'string', 'max:255'],
            'gender' => ['sometimes', 'string', 'max:50'],
        ]);
 
        $page = $filters['p'] ?? 1;
        $limit = $filters['limit'] ?? 100;
 
        $leads = Lead::query()
            ->filter($filters)
            ->latest()
            ->paginate(perPage: $limit, page: $page)
            ->withQueryString();
 
        return LeadResource::collection($leads);
    }
}
