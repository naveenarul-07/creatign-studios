<?php

declare(strict_types=1);

const SITE_NAME = 'OMNITECH Systems';
const SITE_PHONE = '+1 703-281-2340';
const SITE_FAX = '+1 703-291-2343';
const SITE_EMAIL = 'contact@omnitechsys.com';
const SITE_ADDRESS = ['8300 Boone Blvd, Suite 500', 'Vienna, VA 22182'];
const EMPLOYEE_PORTAL = 'https://columbiaedp.evolutionpayroll.com/ess#/login';
const LINKEDIN = 'https://www.linkedin.com/company/omnitech-systems/';

function nav_links(): array
{
    return [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Solutions & Services', 'href' => '/solutions'],
        ['label' => 'Contact', 'href' => '/contact'],
        ['label' => 'Careers', 'href' => '/careers'],
    ];
}

function services(): array
{
    return [
        [
            'slug' => 'data-management',
            'title' => 'Data Management',
            'summary' => 'Architecture, warehousing, migration, and quality programs that keep enterprise data usable and trusted.',
            'items' => [
                'Data Architecture and Engineering',
                'Data Warehousing',
                'Data Migration',
                'Data Quality',
            ],
            'href' => '/contact',
        ],
        [
            'slug' => 'contract-lifecycle-management',
            'title' => 'Contract Lifecycle Management (CLM)',
            'summary' => 'Accountable CLM strategy, vendor selection, implementation, and managed services.',
            'items' => [
                'CLM Vendor (Product) Selection',
                'CLM Strategy',
                'CLM Readiness',
                'CLM Implementation',
                'Data Extraction & Data Migration',
                'Managed Services',
            ],
            'href' => '/solutions/contract-lifecycle-management',
        ],
        [
            'slug' => 'analytics-ai',
            'title' => 'Analytics & AI',
            'summary' => 'Analytics, visualization, and applied AI/ML that turn operational data into decisions.',
            'items' => [
                'Data Analytics',
                'Data Visualization',
                'AI/ML',
            ],
            'href' => '/contact',
        ],
        [
            'slug' => 'devops-infrastructure',
            'title' => 'DevOps & Infrastructure',
            'summary' => 'Cloud platforms, grid computing, and infrastructure products your teams can run every day.',
            'items' => [
                'IaaS, SaaS & PaaS',
                'Grid Computing',
                'IBM Platform Product Suite',
                'AWS, Azure, VMware',
            ],
            'href' => '/contact',
        ],
        [
            'slug' => 'application-development',
            'title' => 'Application Development & Support',
            'summary' => 'Platform delivery and full-stack engineering with the methodology your program needs.',
            'items' => [
                'Salesforce',
                'ServiceNow',
                'Full Stack Development',
                'Waterfall & Agile Methodologies',
            ],
            'href' => '/contact',
        ],
        [
            'slug' => 'strategic-consulting',
            'title' => 'Strategic Consulting',
            'summary' => 'Enterprise, network, and platform strategy, including legacy database migrations.',
            'items' => [
                'Enterprise Data Strategy',
                'IT Strategy',
                'Network & Storage Strategy',
                'Re-Platforming',
                'Legacy DB platform migrations (For eg., Sybase to PostgreSQL, Oracle to MySQL, etc.)',
            ],
            'href' => '/contact',
        ],
        [
            'slug' => 'database',
            'title' => 'Database Design & Administration',
            'summary' => 'Design, administration, and performance tuning across cloud and on-premises databases.',
            'items' => [
                'AWS RDS, AWS Aurora, PostgreSQL, ORACLE, Sybase, MS-SQL Server Administration & Support',
                'Database Design & Architecture',
                'Performance Tuning',
            ],
            'href' => '/contact',
        ],
    ];
}

function service_by_slug(string $slug): ?array
{
    foreach (services() as $service) {
        if ($service['slug'] === $slug) {
            return $service;
        }
    }
    return null;
}

function clm_offerings(): array
{
    return [
        [
            'title' => 'CLM Vendor (Product) Selection',
            'body' => 'Navigating the crowded CLM marketplace? OMNITECH Systems delivers unbiased vendor selection tailored to your business goals. Our expert team’s razor-sharp focus on client needs ensures accountable decisions, aligns technology with organizational strategy, and maximizes your return on investment from day one.',
        ],
        [
            'title' => 'CLM Strategy',
            'body' => 'Achieve strategic clarity with OMNITECH Systems. Driven by our commitment to accountability, our seasoned CLM experts create customized strategies focused on your objectives—streamlining contract processes, reducing risk, enhancing compliance, and ensuring sustainable, profitably managed growth.',
        ],
        [
            'title' => 'CLM Readiness',
            'body' => 'Omnitech’s meticulous readiness approach ensures a smooth CLM transition. Our expert team rigorously assesses organizational preparedness, aligns stakeholders, identifies potential gaps, and primes your environment, demonstrating our commitment to high-quality, accountable delivery from inception.',
        ],
        [
            'title' => 'CLM Implementation',
            'body' => 'OMNITECH Systems expertly manages CLM implementations with precision, accountability, and efficiency. Leveraging proven methodologies, our team optimizes workflows, ensures seamless adoption, and delivers measurable results, reflecting our steadfast dedication to quality and customer-centric excellence.',
        ],
        [
            'title' => 'Data Extraction & Data Migration',
            'body' => 'Protect and leverage your critical contract data through Omnitech’s secure, accountable data extraction and migration services. Our specialists meticulously maintain data integrity, minimizing disruptions while facilitating seamless transitions swiftly, driven by our unwavering commitment to client success.',
        ],
        [
            'title' => 'Managed Services',
            'body' => 'Focus on your strategic goals while Omnitech manages your CLM systems proactively and efficiently. Our accountable managed services continuously optimize performance, provide reliable expert support, and adapt solutions to evolving needs, delivering sustained value aligned with your organization’s growth.',
        ],
    ];
}

function clients(): array
{
    return [
        ['name' => 'Citi', 'file' => 'clients/citi.jpeg'],
        ['name' => 'Sodexo', 'file' => 'clients/sodexo.png'],
        ['name' => 'Tecan', 'file' => 'clients/tecan.png'],
        ['name' => 'SanDisk', 'file' => 'clients/sandisk.jpg'],
        ['name' => 'PTC', 'file' => 'clients/ptc.png'],
        ['name' => 'Fannie Mae', 'file' => 'clients/fannie.jpg'],
    ];
}

function alliances(): array
{
    return [
        ['name' => 'Amazon Web Services', 'file' => 'alliances/aws.jpg'],
        ['name' => 'Salesforce', 'file' => 'alliances/salesforce.jpeg'],
        ['name' => 'Microsoft Azure', 'file' => 'alliances/azure.jpg'],
        ['name' => 'VMware', 'file' => 'alliances/vmware.png'],
        ['name' => 'ServiceNow', 'file' => 'alliances/servicenow.png'],
        ['name' => 'Autodesk', 'file' => 'alliances/autodesk.png'],
        ['name' => 'SAP', 'file' => 'alliances/sap.jpg'],
        ['name' => 'Microsoft', 'file' => 'alliances/msdn.jpg'],
        ['name' => 'Conga', 'file' => 'alliances/conga.webp'],
        ['name' => 'Agiloft', 'file' => 'alliances/agiloft.jpg'],
        ['name' => 'Icertis', 'file' => 'alliances/icertis.jpg'],
        ['name' => 'Malbek', 'file' => 'alliances/malbek.webp'],
        ['name' => 'DocuSign', 'file' => 'alliances/docusign.png'],
        ['name' => 'Leah', 'file' => 'alliances/leah.jpg'],
        ['name' => 'IntelAgree', 'file' => 'alliances/intelagree.jpg'],
        ['name' => 'ContractPodAi', 'file' => 'alliances/contracts.jpg'],
    ];
}

function benefits(): array
{
    return [
        [
            'title' => 'Health Insurance',
            'body' => 'We offer our full-time employees and all their dependents medical and dental health coverage.',
        ],
        [
            'title' => 'Paid Vacation',
            'body' => 'We offer our full time employees 10 working days of paid vacation per year.',
        ],
        [
            'title' => 'Paid Sick Leave',
            'body' => 'We offer our full time employees 5 working days of sick leave per year.',
        ],
    ];
}

function jobs(): array
{
    return [
        [
            'slug' => 'ai-ml-developer',
            'title' => 'AI/ML Developer',
            'intro' => 'We are looking for an AI/ML Developer with the following skills and experience:',
            'location' => 'Northern Virginia (Currently Remote)',
            'sections' => [
                [
                    'heading' => 'Responsibilities',
                    'items' => [
                        'Strong Development experience on emerging technologies using AIML services.',
                        'Should have experience in all phases of the software development life cycle (SDLC), including design, development, and maintenance of applications.',
                        'Prototype, develop, and analyze software.',
                        'Perform peer reviews on source code to ensure reuse, scalability, and the use of best practices.',
                        'Participate in collaborative technical discussions that focus on software design, architecture, and development as well as user experience.',
                        'Provide continuous feedback to refine current practices, promote timely software release cycles, and improve agile methods.',
                    ],
                ],
                [
                    'heading' => 'Requirements',
                    'items' => [
                        '5+ years of experience with a software development team',
                        '3+ years of experience with agile methodologies',
                        'Experience with C#',
                        'Experience with implementing RESTful APIs',
                        'Experience with Natural Language Processing or Chatbot development',
                        'Knowledge of database concepts and CRUD operations',
                        'Experience with Azure Cloud Services',
                        'Experience with JavaScript',
                        'Experience with Python',
                        'Experience with mentoring junior developers',
                        'Professional experience in the AI or Data Science field',
                        'MS degree in CS or IT related field',
                    ],
                ],
            ],
        ],
        [
            'slug' => 'enterprise-data-architect',
            'title' => 'Enterprise Data Architect',
            'intro' => 'We are looking for an Enterprise Data Architect with the following skill sets.',
            'location' => 'Northern Virginia (Currently Remote)',
            'body' => 'An enterprise data architect’s primary goal is to keep data easily accessible and accurate. To meet that goal, this architect reviews, refines and implements data standards. Examples of data standards include those that define how data is categorized or how alphanumeric codes are assigned to represent specific products, customers and other data types. After gathering information about data use in the workplace, this architect creates a blueprint or road map, showing processes and services that affect data use and data standards. The architect then works with project managers and business stakeholders to implement that design.',
            'sections' => [
                [
                    'heading' => 'Qualifications',
                    'items' => [
                        '8+ years of relevant hands-on technical experience in an enterprise environment',
                        'Preference will be given to those with strong experience on Agile/DevOps environment.',
                        'Demonstrable senior-level expertise in the following disciplines: Cloud Services and Solutions; Database Administration and Development; Analytical Sciences; Information Technology Governance; Information Security; Information Technology Resource Management; Business Case; Business Scenario; Business Process Design; Strategic Planning; and Business Functions.',
                    ],
                ],
            ],
        ],
        [
            'slug' => 'lead-data-scientist',
            'title' => 'Lead Data Scientist',
            'intro' => 'We are looking for a Lead Data Scientist to extract and analyze data from different type of documents. You will be working with large data sets combing structured and unstructured data. You will be building a team of Data Scientists to develop products and tools.',
            'location' => 'Northern Virginia (Currently Remote)',
            'sections' => [
                [
                    'heading' => 'Essential Duties and Responsibilities',
                    'items' => [
                        'Develop and apply the latest innovations in machine learning, artificial intelligence, and related technologies.',
                        'Lead and support research and development efforts to explore the applicability of emerging machine learning and artificial intelligence methods to address client challenges and identify and prioritize emerging methods and challenges for original research or proof of concepts.',
                        'Lead and support efforts to identify, shape, capture, and deliver data science, machine learning, and artificial intelligence contracts.',
                        'Work with clients and internal team to build analytic strategies, technology roadmaps, implementation plans, and research initiatives.',
                        'Lead and develop a strong team of data scientists, data engineers, machine learning engineers, and artificial intelligence specialists.',
                    ],
                ],
                [
                    'heading' => 'Minimum Qualifications',
                    'items' => [
                        'Over 5 years of experience with machine learning techniques (clustering, decision tree learning, artificial neural networks, Natural Language Processing, etc.) and algorithms for addressing a variety of problems.',
                        'Over 5 years of experience with leading or managing delivery teams, projects and development efforts.',
                        'Over 3 years of experience with programming, including in machine learning frameworks (TensorFlow, PyTorch), python, Spark.',
                        'Very strong experience with distributed data/computing tools: Map/Reduce, Hadoop, Hive, Spark, MySQL.',
                        'Experience with business development, client or customer relationship management.',
                        'Experience with developing effective delivery or research teams, including recruiting, hiring, mentoring, coaching, and managing team members.',
                        'Ability to effectively communicate results to both technical and non-technical audiences, including presenting to senior executives.',
                        'BA or BS degree in Statistics, Machine Learning, Mathematics, CS, Computer Engineering, Industrial Engineering, or Operations Research.',
                    ],
                ],
                [
                    'heading' => 'Preferred Qualifications',
                    'items' => [
                        'MS degree in Science, Engineering, Mathematics, or related field preferred; PhD degree a plus.',
                    ],
                ],
            ],
        ],
    ];
}

function job_by_slug(string $slug): ?array
{
    foreach (jobs() as $job) {
        if ($job['slug'] === $slug) {
            return $job;
        }
    }
    return null;
}
