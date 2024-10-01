<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Config\MailTemplateRequest;
use App\Http\Resources\Config\MailTemplateResource;
use App\Models\Config\MailTemplate;
use App\Services\Config\MailTemplateListService;
use App\Services\Config\MailTemplateService;
use App\Support\MailTemplateParser;
use Illuminate\Http\Request;

class MailTemplateController extends Controller
{
    use MailTemplateParser;

    public function index(Request $request, MailTemplateListService $service)
    {
        return $service->paginate($request);
    }

    public function show(MailTemplate $mailTemplate)
    {
        request()->merge(['detail' => true]);

        return MailTemplateResource::make($mailTemplate);
    }

    public function detail(MailTemplate $mailTemplate)
    {
        $body = $this->parse($mailTemplate->content);

        return view('email.index', ['body' => $body]);
    }

    public function update(MailTemplateRequest $request, MailTemplate $mailTemplate, MailTemplateService $service)
    {
        $service->update($request, $mailTemplate);

        return response()->success(['message' => trans('global.updated', ['attribute' => trans('config.mail.template.template')])]);
    }
}
