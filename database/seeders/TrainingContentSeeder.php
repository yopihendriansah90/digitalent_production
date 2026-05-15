<?php

namespace Database\Seeders;

use App\Models\TrainingContent;
use Illuminate\Database\Seeder;

class TrainingContentSeeder extends Seeder
{
    public function run(): void
    {
        TrainingContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Katalog training terstruktur berdasarkan domain, format belajar, dan relevansi industri.',
                    'en' => 'Training catalog structured by domain, learning format, and industry relevance.',
                ],
                'hero_background_mode' => 'color',
                'show_domain_numbering' => true,
                'hero_cards' => [
                    [
                        'title' => ['id' => 'Cakupan', 'en' => 'Coverage'],
                        'body' => ['id' => 'Delapan kategori domain dari GRC hingga manajemen proyek.', 'en' => 'Eight domain categories from GRC to project management.'],
                    ],
                    [
                        'title' => ['id' => 'Format Pembelajaran', 'en' => 'Learning Format'],
                        'body' => ['id' => 'Program siap katalog untuk jalur pembelajaran terstruktur dan relevan industri.', 'en' => 'Catalog-ready programs for structured and industry-relevant learning paths.'],
                    ],
                ],
                'domains' => [
                    [
                        'title' => ['id' => 'Cybersecurity', 'en' => 'Cybersecurity'],
                        'body' => [
                            'id' => '<ul><li>Juniper Security (JSEC)</li><li>Mobile Security Application &amp; Penetration Testing</li><li>Junior Penetration Tester</li><li>Incident Response Digital Forensic</li><li>Network Security</li><li>Web Application Penetration Testing</li><li>MITRE ATT&amp;CK Framework</li><li>ISC2: CISSP (Certified Information System Security Professional)</li><li>CompTIA Security</li><li>CompTia PenTest</li><li>CompTIA CySA</li><li>etc.</li></ul>',
                            'en' => '<ul><li>Juniper Security (JSEC)</li><li>Mobile Security Application &amp; Penetration Testing</li><li>Junior Penetration Tester</li><li>Incident Response Digital Forensic</li><li>Network Security</li><li>Web Application Penetration Testing</li><li>MITRE ATT&amp;CK Framework</li><li>ISC2: CISSP (Certified Information System Security Professional)</li><li>CompTIA Security</li><li>CompTia PenTest</li><li>CompTIA CySA</li><li>etc.</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                    [
                        'title' => ['id' => 'GRC', 'en' => 'GRC'],
                        'body' => [
                            'id' => '<ul><li>IT Governance &amp; Strategic Planning</li><li>IT Risk Management</li><li>Vendor Risk Management</li><li>IT Disaster Recovery Planning Development</li><li>Practical IT Auditing</li><li>Cybersecurity Law &amp; Regulation</li><li>COBIT</li><li>etc</li></ul>',
                            'en' => '<ul><li>IT Governance &amp; Strategic Planning</li><li>IT Risk Management</li><li>Vendor Risk Management</li><li>IT Disaster Recovery Planning Development</li><li>Practical IT Auditing</li><li>Cybersecurity Law &amp; Regulation</li><li>COBIT</li><li>etc</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                    [
                        'title' => ['id' => 'IT Operations and Infrastructure', 'en' => 'IT Operations and Infrastructure'],
                        'body' => [
                            'id' => '<ul><li>Information Technology Infrastructure Library (ITIL)</li><li>Kubernetes Microservices</li><li>Cloud Computing</li><li>CompTIA ITF+ (IT Fundamentals)</li><li>CompTIA A+</li><li>CompTIA Network+</li><li>CompTIA Linux +</li><li>CompTIA Cloud+</li><li>etc</li></ul>',
                            'en' => '<ul><li>Information Technology Infrastructure Library (ITIL)</li><li>Kubernetes Microservices</li><li>Cloud Computing</li><li>CompTIA ITF+ (IT Fundamentals)</li><li>CompTIA A+</li><li>CompTIA Network+</li><li>CompTIA Linux +</li><li>CompTIA Cloud+</li><li>etc</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                    [
                        'title' => ['id' => 'IT Architecture', 'en' => 'IT Architecture'],
                        'body' => [
                            'id' => '<ul><li>Enterprise Architecture Management</li><li>IT Architecture Planning</li><li>TOGAF 10 Enterprise Architecture</li><li>Micro Services Architecture</li><li>Juniper Networks Design Fundamentals (JNDF)</li><li>I2: ISSAP (Information System Security Architecture Professional)</li><li>etc</li></ul>',
                            'en' => '<ul><li>Enterprise Architecture Management</li><li>IT Architecture Planning</li><li>TOGAF 10 Enterprise Architecture</li><li>Micro Services Architecture</li><li>Juniper Networks Design Fundamentals (JNDF)</li><li>I2: ISSAP (Information System Security Architecture Professional)</li><li>etc</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                    [
                        'title' => ['id' => 'Software Development', 'en' => 'Software Development'],
                        'body' => [
                            'id' => '<ul><li>Software Engineering Process, Method &amp; Maintenance Knowledge Areas</li><li>Software Quality Assurance</li><li>Android Application Development-Programming</li><li>iOS Development for Professional</li><li>UI-UX Design</li><li>DevOps Fundamental</li><li>Secure Coding</li><li>DevSecOps</li><li>etc</li></ul>',
                            'en' => '<ul><li>Software Engineering Process, Method &amp; Maintenance Knowledge Areas</li><li>Software Quality Assurance</li><li>Android Application Development-Programming</li><li>iOS Development for Professional</li><li>UI-UX Design</li><li>DevOps Fundamental</li><li>Secure Coding</li><li>DevSecOps</li><li>etc</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                    [
                        'title' => ['id' => 'Management & IT BA', 'en' => 'Management & IT BA'],
                        'body' => [
                            'id' => '<ul><li>IT Master Plan</li><li>IT Business Process</li><li>Information System Quality Assurance (Framework)</li><li>Business Process Management</li><li>Business Analysis</li><li>Implementing KPI : Using Key performance Indicator</li><li>etc.</li></ul>',
                            'en' => '<ul><li>IT Master Plan</li><li>IT Business Process</li><li>Information System Quality Assurance (Framework)</li><li>Business Process Management</li><li>Business Analysis</li><li>Implementing KPI : Using Key performance Indicator</li><li>etc.</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                    [
                        'title' => ['id' => 'Project Management', 'en' => 'Project Management'],
                        'body' => [
                            'id' => '<ul><li>PMI-Risk Management Professional</li><li>IT Project Management</li><li>IT Project Asset Management</li><li>SCRUM Master</li><li>Project Management Professional</li><li>Agile SCRUM Foundation</li><li>etc.</li></ul>',
                            'en' => '<ul><li>PMI-Risk Management Professional</li><li>IT Project Management</li><li>IT Project Asset Management</li><li>SCRUM Master</li><li>Project Management Professional</li><li>Agile SCRUM Foundation</li><li>etc.</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                    [
                        'title' => ['id' => 'Data & Artificial Intelligence', 'en' => 'Data & Artificial Intelligence'],
                        'body' => [
                            'id' => '<ul><li>Data Management</li><li>Data Science</li><li>Data Engineer</li><li>Data Integration</li><li>Introduction to Data Science</li><li>Introduction to Big Data</li><li>Machine Learning</li><li>Python Programming</li><li>CompTIA Data+</li><li>etc.</li></ul>',
                            'en' => '<ul><li>Data Management</li><li>Data Science</li><li>Data Engineer</li><li>Data Integration</li><li>Introduction to Data Science</li><li>Introduction to Big Data</li><li>Machine Learning</li><li>Python Programming</li><li>CompTIA Data+</li><li>etc.</li></ul>',
                        ],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                        'link' => '',
                    ],
                ],
            ]
        );
    }
}
