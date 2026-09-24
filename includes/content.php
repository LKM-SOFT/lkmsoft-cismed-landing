<?php
/**
 * Product content shared across pages (home, features, specialties).
 * Only features confirmed in the CIS codebase are listed here.
 */

/** Shown wherever the consultation sheets are listed. */
const CONSULTATION_SHEETS_NOTE = 'Estamos incorporando más hojas de consulta especializadas para otras especialidades';

const MODULES = [
    [
        'anchor'  => 'scheduling',
        'icon'    => 'calendar-days',
        'title'   => 'Agenda médica',
        'summary' => 'Horarios por especialidad, cupos extra y vista de calendario con arrastrar y soltar',
        'heading' => 'Una agenda que se adapta a tu forma de trabajar',
        'intro'   => 'Organiza la agenda de uno o varios médicos con horarios por especialidad y la vista que cada usuario prefiera',
        'points'  => [
            'Horario por especialidad: fijo o distinto para cada día',
            'Duración de cita, límite de pacientes por día y cupos extra',
            'Registro de días no laborables',
            'Vista clásica o de calendario por día y por semana',
            'Agenda con un clic en un espacio libre y reprograma arrastrando la cita',
            'Confirma, edita, reprograma, cancela o cambia la cita a otro médico',
            'Agendas de varios médicos lado a lado para el administrador',
            'Dashboard con las citas del día en listado o en calendario',
        ],
        'image'   => ['src' => 'images/mockups/agenda-week.svg', 'width' => 760, 'height' => 560, 'alt' => 'Vista semanal de la agenda de CISMed con una cita siendo reprogramada'],
    ],
    [
        'anchor'  => 'notifications',
        'icon'    => 'bell-ring',
        'title'   => 'Notificaciones',
        'summary' => 'Recordatorios de cita por correo electrónico, SMS y WhatsApp, además de avisos internos',
        'heading' => 'Recordatorios que llegan solos',
        'intro'   => 'Mantén informados a tus pacientes y a tu equipo sin tener que llamar ni escribir uno por uno',
        'points'  => [
            'Recordatorios de cita para tus pacientes',
            'Envío por correo electrónico',
            'Envío por SMS',
            'Envío por WhatsApp',
            'Notificaciones internas para el equipo del consultorio',
        ],
        'tags'    => ['Correo electrónico', 'SMS', 'WhatsApp', 'Avisos internos'],
    ],
    [
        'anchor'  => 'patients',
        'icon'    => 'users',
        'title'   => 'Pacientes',
        'summary' => 'Registro con sugerencias, autocompletado y validación de CURP',
        'heading' => 'Registros de pacientes rápidos y confiables',
        'intro'   => 'Da de alta a tus pacientes en menos pasos y con datos verificados desde el inicio',
        'points'  => [
            'Registro de pacientes con sugerencias y autocompletado',
            'Validación de CURP mediante un servicio externo',
            'Permisos para controlar quién consulta la información',
        ],
        'tags'    => ['Autocompletado', 'CURP validada', 'Permisos'],
    ],
    [
        'anchor'  => 'medical-records',
        'icon'    => 'clipboard-list',
        'title'   => 'Historia clínica',
        'summary' => 'Hoja frontal, antecedentes completos, desarrollo motor y cartilla de vacunación',
        'heading' => 'Toda la historia clínica en un solo expediente',
        'intro'   => 'Consulta y actualiza la información del paciente de forma ordenada, sin papeles ni archivos sueltos',
        'points'  => [
            'Hoja frontal del paciente',
            'Antecedentes heredofamiliares, patológicos, no patológicos, familiares y sociales',
            'Antecedentes ginecológicos y gineco-obstétricos',
            'Desarrollo motor',
            'Contactos del paciente',
            'Cartilla de vacunación basada en las cartillas oficiales vigentes',
        ],
        'tags'    => ['Hoja frontal', 'Antecedentes', 'Cartilla de vacunación'],
    ],
    [
        'anchor'  => 'consultations',
        'icon'    => 'stethoscope',
        'title'   => 'Consultas',
        'summary' => 'Consulta general y hojas de consulta especializadas, historial, estadísticas y gráficas de crecimiento',
        'heading' => 'Consultas con el formato de tu especialidad',
        'intro'   => 'Registra cada consulta con la hoja que tu especialidad necesita y revisa la evolución del paciente. ' . CONSULTATION_SHEETS_NOTE,
        'points'  => [
            'Hoja de consulta de medicina general',
            'Hoja de consulta de ginecología, con control prenatal y diagnóstico de climaterio',
            'Hoja de consulta de pediatría',
            'Hoja de consulta de estomatología, con odontograma',
            'Hoja de consulta de oftalmología, con examen optométrico, segmento anterior, fondo de ojo y graduación de lentes',
            'Historial de consultas del paciente',
            'Estadísticas de consultas',
            'Gráficas de crecimiento',
        ],
        'tags'    => ['Hojas especializadas', 'Odontograma', 'Gráficas de crecimiento'],
    ],
    [
        'anchor'  => 'prescriptions',
        'icon'    => 'pill',
        'title'   => 'Recetas',
        'summary' => 'Formatos de receta configurables por cada médico',
        'heading' => 'Recetas con tu propio formato',
        'intro'   => 'Cada médico configura el formato de receta que usa en su práctica',
        'points'  => [
            'Formatos de receta configurables por médico',
        ],
        'tags'    => ['Formato por médico'],
    ],
    [
        'anchor'  => 'billing',
        'icon'    => 'receipt',
        'title'   => 'Facturación CFDI',
        'summary' => 'Catálogos del SAT, conceptos con impuestos, timbrado y descarga de facturas',
        'heading' => 'Factura tus consultas sin otro sistema',
        'intro'   => 'La facturación electrónica CFDI está integrada a CISMed, así que no necesitas contratar ni aprender otra herramienta',
        'points'  => [
            'Registro de emisores y receptores',
            'Catálogos del SAT',
            'Conceptos con impuestos',
            'Timbrado de facturas',
            'Descarga de facturas',
            'Facturación de consultas',
        ],
        'tags'    => ['CFDI', 'Catálogos del SAT', 'Timbrado'],
    ],
    [
        'anchor'  => 'security',
        'icon'    => 'shield-check',
        'title'   => 'Seguridad',
        'summary' => 'Roles y permisos por pantalla, OTP, registro de dispositivos y bitácora de auditoría',
        'heading' => 'La información de tus pacientes, protegida',
        'intro'   => 'Controla quién entra, desde dónde y a qué información tiene acceso',
        'points'  => [
            'Roles y niveles de acceso por pantalla',
            'Verificación con OTP y PIN',
            'Registro de dispositivos',
            'Control de intentos de acceso',
            'Cifrado de datos personales sensibles conforme a la LFPDPPP',
            'Bitácora de auditoría',
        ],
        'tags'    => ['OTP y PIN', 'Datos cifrados', 'Bitácora'],
    ],
];

const SPECIALTIES = [
    [
        'slug'    => 'general-medicine',
        'icon'    => 'stethoscope',
        'title'   => 'Medicina general',
        'summary' => 'Hoja de consulta general con historial y estadísticas',
        'intro'   => 'Atiende a tus pacientes con su historia clínica completa a la mano',
        'points'  => [
            'Hoja de consulta de medicina general',
            'Historia clínica con hoja frontal y antecedentes',
            'Historial de consultas',
            'Estadísticas de consultas',
        ],
    ],
    [
        'slug'    => 'gynecology',
        'icon'    => 'venus',
        'title'   => 'Ginecología',
        'summary' => 'Control prenatal, diagnóstico de climaterio y antecedentes gineco-obstétricos',
        'intro'   => 'Registra la información ginecológica y obstétrica de tus pacientes en su expediente',
        'points'  => [
            'Hoja de consulta de ginecología',
            'Control prenatal',
            'Diagnóstico de climaterio',
            'Antecedentes ginecológicos y gineco-obstétricos',
            'Historial de consultas',
        ],
    ],
    [
        'slug'    => 'pediatrics',
        'icon'    => 'baby',
        'title'   => 'Pediatría',
        'summary' => 'Desarrollo motor, cartilla de vacunación y gráficas de crecimiento',
        'intro'   => 'Da seguimiento al crecimiento y desarrollo de cada niño desde su expediente',
        'points'  => [
            'Hoja de consulta de pediatría',
            'Desarrollo motor',
            'Cartilla de vacunación basada en las cartillas oficiales vigentes',
            'Gráficas de crecimiento',
        ],
    ],
    [
        'slug'    => 'stomatology',
        'icon'    => 'smile',
        'title'   => 'Estomatología',
        'summary' => 'Hoja de consulta estomatológica con odontograma',
        'intro'   => 'Lleva tus consultas estomatológicas en el mismo expediente que el resto de la información del paciente',
        'points'  => [
            'Hoja de consulta de estomatología',
            'Odontograma',
            'Historia clínica y antecedentes del paciente',
            'Historial de consultas',
        ],
    ],
    [
        'slug'    => 'ophthalmology',
        'icon'    => 'eye',
        'title'   => 'Oftalmología',
        'summary' => 'Examen optométrico, segmento anterior, fondo de ojo y graduación de lentes',
        'intro'   => 'Registra la exploración oftalmológica completa sin tener que escribirla en texto libre',
        'points'  => [
            'Hoja de consulta de oftalmología',
            'Agudeza visual de lejos y de cerca, con cartillas para niños',
            'Exploración de segmento anterior y fondo de ojo, con plantilla de hallazgos normales',
            'Refracción, queratometrías y presión intraocular',
            'Diagnósticos por ojo con catálogo CIE-10',
        ],
    ],
];

/**
 * Consultation sheets being built. The blurred suffix plus the loading placeholder in the card
 * signal "work in progress" without promising a date.
 */
const UPCOMING_SPECIALTIES = [
    ['icon' => 'heart-pulse', 'prefix' => 'Cardio', 'suffix' => 'logía', 'title' => 'Cardiología'],
    ['icon' => 'droplets',    'prefix' => 'Nefro',  'suffix' => 'logía', 'title' => 'Nefrología'],
    ['icon' => 'bone',        'prefix' => 'Ortop',  'suffix' => 'edia',  'title' => 'Ortopedia'],
];

/** Features listed in every plan card, in the same order as in the application. */
const PLAN_FEATURES = [
    'Agenda médica',
    'Consulta externa y hojas de consulta especializadas',
    'Receta electrónica',
    'Almacenamiento ilimitado en la nube',
    'Estadísticas y reportes',
    'Notificaciones y recordatorios vía correo electrónico',
    'Notificaciones y recordatorios vía SMS',
    'Notificaciones y recordatorios vía WhatsApp',
    'Facturación electrónica',
];

/**
 * Licence plans. 'included' holds the number of features from PLAN_FEATURES that the plan covers;
 * the rest are shown as not included.
 */
const PLANS = [
    ['name' => 'Classic',  'price' => 400,  'doctors' => 1,  'assistants' => '1',         'included' => 7],
    ['name' => 'Master',   'price' => 600,  'doctors' => 2,  'assistants' => '2',         'included' => 8],
    ['name' => 'Premium',  'price' => 900,  'doctors' => 3,  'assistants' => 'Ilimitado', 'included' => 9],
    ['name' => 'Gold',     'price' => 1250, 'doctors' => 5,  'assistants' => 'Ilimitado', 'included' => 9],
    ['name' => 'Platinum', 'price' => 1750, 'doctors' => 7,  'assistants' => 'Ilimitado', 'included' => 9],
    ['name' => 'Black',    'price' => 2500, 'doctors' => 10, 'assistants' => 'Ilimitado', 'included' => 9],
];

/** Billing cycles available for every plan. */
const BILLING_CYCLES = ['Mensual', 'Trimestral', 'Semestral', 'Anual'];

const AUDIENCES = [
    ['icon' => 'user-round', 'title' => 'Médicos independientes',      'text' => 'Lleva tu agenda, expedientes, recetas y facturas desde un solo lugar'],
    ['icon' => 'building-2', 'title' => 'Clínicas con varios médicos', 'text' => 'Cuenta maestra para la clínica y agendas de varios médicos lado a lado'],
    ['icon' => 'users',      'title' => 'Enfermeras y asistentes',     'text' => 'Trabajan para uno o varios médicos con los permisos que cada uno necesita'],
    ['icon' => 'user-cog',   'title' => 'Administradores',             'text' => 'Controlan roles, niveles de acceso por pantalla y la bitácora de auditoría'],
];

/**
 * Frequently asked questions grouped by topic. Items marked 'featured' also appear on the home page.
 */
const FAQ_GROUPS = [
    [
        'id'    => 'general',
        'icon'  => 'info',
        'title' => 'Información general',
        'items' => [
            ['q' => '¿Qué es CISMed?', 'a' => 'CISMed es un expediente clínico electrónico con gestión integral del consultorio: agenda médica, pacientes, historia clínica, consultas, recetas, facturación CFDI y seguridad de la información, en la nube y pensado para México'],
            ['q' => '¿Necesito instalar algo para usar CISMed?', 'a' => 'No. CISMed funciona en la nube, así que entras desde tu navegador sin instalar ni mantener servidores', 'featured' => true],
            ['q' => '¿Para quién es CISMed?', 'a' => 'Para médicos que ejercen de forma independiente, clínicas con varios médicos, enfermeras y asistentes que trabajan para uno o varios médicos, y administradores de la clínica'],
            ['q' => '¿Mi asistente o enfermera puede usar el sistema?', 'a' => 'Sí. Las enfermeras y asistentes pueden trabajar para uno o varios médicos, con los permisos que se les asignen', 'featured' => true],
            ['q' => '¿Quién desarrolla CISMed?', 'a' => 'CISMed es un producto de LKM Soft'],
        ],
    ],
    [
        'id'    => 'scheduling',
        'icon'  => 'calendar-days',
        'title' => 'Agenda y pacientes',
        'items' => [
            ['q' => '¿Puedo configurar mi horario de consulta?', 'a' => 'Sí. Defines tu horario por especialidad, fijo o distinto para cada día, con la duración de las citas, un límite de pacientes por día, cupos extra y tus días no laborables'],
            ['q' => '¿Cómo se ve la agenda?', 'a' => 'Cada usuario elige entre la vista clásica y la vista de calendario por día o por semana. En el calendario puedes agendar con un clic en un espacio libre y reprogramar arrastrando la cita'],
            ['q' => '¿Se envían recordatorios de cita a los pacientes?', 'a' => 'Sí. CISMed envía recordatorios de cita por correo electrónico, SMS y WhatsApp, además de notificaciones internas para el equipo'],
            ['q' => '¿Funciona para clínicas con varios médicos?', 'a' => 'Sí. La clínica tiene una cuenta maestra, el administrador puede ver las agendas de varios médicos lado a lado y una cita se puede reprogramar con otro médico'],
            ['q' => '¿Cómo se registran los pacientes?', 'a' => 'El registro ofrece sugerencias y autocompletado, y la CURP del paciente se valida mediante un servicio externo'],
        ],
    ],
    [
        'id'    => 'records',
        'icon'  => 'clipboard-list',
        'title' => 'Expediente y consultas',
        'items' => [
            ['q' => '¿Qué incluye la historia clínica?', 'a' => 'Hoja frontal; antecedentes heredofamiliares, patológicos, no patológicos, familiares y sociales; antecedentes ginecológicos y gineco-obstétricos; desarrollo motor; contactos del paciente y cartilla de vacunación basada en las cartillas oficiales vigentes'],
            ['q' => '¿Qué especialidades tienen hoja de consulta?', 'a' => 'CISMed incluye la hoja de consulta general y hojas de consulta especializadas: ginecología, con control prenatal y diagnóstico de climaterio; pediatría; estomatología, con odontograma, y oftalmología, con examen optométrico, segmento anterior, fondo de ojo y graduación de lentes. También hay historial de consultas, estadísticas y gráficas de crecimiento. ' . CONSULTATION_SHEETS_NOTE],
            ['q' => '¿Puedo usar mi propio formato de receta?', 'a' => 'Sí. Cada médico configura el formato de receta que usa en su práctica'],
        ],
    ],
    [
        'id'    => 'billing',
        'icon'  => 'receipt',
        'title' => 'Facturación',
        'items' => [
            ['q' => '¿Puedo facturar mis consultas desde CISMed?', 'a' => 'Sí. La facturación electrónica CFDI está integrada: catálogos del SAT, conceptos con impuestos, timbrado y descarga de facturas, incluida la facturación de consultas', 'featured' => true],
            ['q' => '¿Necesito contratar otro sistema para facturar?', 'a' => 'No. Emisores, receptores, conceptos y timbrado se manejan desde el mismo CISMed'],
        ],
    ],
    [
        'id'    => 'security',
        'icon'  => 'shield-check',
        'title' => 'Seguridad y privacidad',
        'items' => [
            ['q' => '¿Cómo se protegen los datos de mis pacientes?', 'a' => 'Los datos personales sensibles se cifran conforme a la LFPDPPP. Además hay roles y niveles de acceso por pantalla, OTP, PIN, registro de dispositivos, control de intentos de acceso y bitácora de auditoría', 'featured' => true],
            ['q' => '¿Puedo controlar qué ve cada persona de mi equipo?', 'a' => 'Sí. Los roles y niveles de acceso se definen por pantalla, y la bitácora de auditoría registra la actividad en el sistema'],
        ],
    ],
    [
        'id'    => 'getting-started',
        'icon'  => 'send',
        'title' => 'Contratación',
        'items' => [
            ['q' => '¿Cómo obtengo información sobre las licencias?', 'a' => 'Déjanos tus datos en el formulario de contacto o escríbenos a info@cismed.mx y te compartimos la información de las licencias de CISMed'],
        ],
    ],
];

/**
 * Returns the FAQ items marked as featured, across all groups.
 */
function featured_faqs(): array
{
    $featured = [];
    foreach (FAQ_GROUPS as $group) {
        foreach ($group['items'] as $item) {
            if (!empty($item['featured'])) {
                $featured[] = $item;
            }
        }
    }

    return $featured;
}
