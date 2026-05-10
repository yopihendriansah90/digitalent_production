<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactInquiryRequest;
use App\Models\ContactInquiry;
use App\Services\Content\PageContentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyProfileController extends Controller
{
    public function __construct(private readonly PageContentService $contentService)
    {
    }

    public function home(): View
    {
        return $this->renderCorePage('home', 'pages.home');
    }

    public function about(): View
    {
        return $this->renderCorePage('about', 'pages.about');
    }

    public function services(): View
    {
        return $this->renderCorePage('services', 'pages.services');
    }

    public function contact(): View
    {
        return $this->renderCorePage('contact', 'pages.contact');
    }

    public function visionMission(): View
    {
        return $this->renderCorePage('vision-mission', 'pages.vision-mission');
    }

    public function portfolio(): View
    {
        return $this->renderCorePage('portfolio', 'pages.portfolio');
    }

    public function training(): View
    {
        return $this->renderCorePage('training', 'pages.training');
    }

    public function outsourcing(): View
    {
        return $this->renderCorePage('outsourcing', 'pages.outsourcing');
    }

    public function submitContact(StoreContactInquiryRequest $request): RedirectResponse
    {
        ContactInquiry::query()->create([
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->toString(),
            'service_type' => $request->string('service_type')->toString() ?: null,
            'message' => $request->string('message')->toString(),
            'status' => ContactInquiry::STATUS_NEW,
        ]);

        return back()->with('success', 'Pesan Anda sudah terkirim. Tim kami akan segera menghubungi Anda.');
    }

    private function renderCorePage(string $slug, string $view): View
    {
        $content = $this->contentService->getPageContent($slug);

        return view($view, [
            'page' => $content['page'],
            'sections' => $content['sections'],
        ]);
    }
}
