<?php

namespace App\Services\Config;

use App\Models\Config\MailTemplate;
use Illuminate\Http\Request;

class MailTemplateService
{
    public function update(Request $request, MailTemplate $mailTemplate)
    {
        $mailTemplate->subject = $request->subject;
        $mailTemplate->content = str_replace("\n", '', clean($request->content));

        $mailTemplate->save();
    }
}
