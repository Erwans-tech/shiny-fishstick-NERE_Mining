@php $companyBase = $en ? route('english.company') : route('company'); @endphp
<div class="sub-nav">
    <a href="{{ $companyBase }}" class="{{ $section === 'company' ? 'active' : '' }}">{{ __('site.subnav_overview', [], $loc) }}</a>
    <a href="{{ $en ? route('english.company.ceo') : route('company.ceo') }}" class="{{ $section === 'company-ceo' ? 'active' : '' }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
    <a href="{{ $en ? route('english.company.identity') : route('company.identity') }}" class="{{ $section === 'company-identity' ? 'active' : '' }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
    <a href="{{ $en ? route('english.company.history') : route('company.history') }}" class="{{ $section === 'company-history' ? 'active' : '' }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
    <a href="{{ $en ? route('english.company.values') : route('company.values') }}" class="{{ $section === 'company-values' ? 'active' : '' }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
    <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}" class="{{ $section === 'company-governance' ? 'active' : '' }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
</div>