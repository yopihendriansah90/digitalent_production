<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactInquiryRequest;
use App\Models\AboutContent;
use App\Models\ContactContent;
use App\Models\ContactInquiry;
use App\Models\HomeContent;
use App\Models\OutsourcingContent;
use App\Models\PortfolioContent;
use App\Models\ServicesContent;
use App\Models\TrainingContent;
use App\Models\VisionMissionContent;
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
        $content = $this->contentService->getPageContent('home');

        return view('pages.home', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'homeContent' => HomeContent::query()->first(),
        ]);
    }

    public function about(): View
    {
        $content = $this->contentService->getPageContent('about');

        return view('pages.about', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'aboutContent' => AboutContent::query()->first(),
        ]);
    }

    public function services(): View
    {
        $content = $this->contentService->getPageContent('services');

        return view('pages.services', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'servicesContent' => ServicesContent::query()->first(),
        ]);
    }

    public function contact(): View
    {
        $content = $this->contentService->getPageContent('contact');

        return view('pages.contact', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'contactContent' => ContactContent::query()->first(),
        ]);
    }

    public function visionMission(): View
    {
        $content = $this->contentService->getPageContent('vision-mission');

        return view('pages.vision-mission', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'visionMissionContent' => VisionMissionContent::query()->first(),
        ]);
    }

    public function portfolio(): View
    {
        $content = $this->contentService->getPageContent('portfolio');

        return view('pages.portfolio', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'portfolioContent' => PortfolioContent::query()->first(),
        ]);
    }

    public function training(): View
    {
        $content = $this->contentService->getPageContent('training');

        return view('pages.training', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'trainingContent' => TrainingContent::query()->first(),
        ]);
    }

    public function outsourcing(): View
    {
        $content = $this->contentService->getPageContent('outsourcing');

        return view('pages.outsourcing', [
            'page' => $content['page'],
            'sections' => $content['sections'],
            'outsourcingContent' => OutsourcingContent::query()->first(),
        ]);
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
