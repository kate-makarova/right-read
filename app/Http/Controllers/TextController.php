<?php


namespace App\Http\Controllers;

use App\Http\Services\TextTagService;
use App\Text;
use App\Word;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TextController extends Controller
{
    public function index()
    {
        $books = Text::all()->toArray();
        return response()->json(array_reverse($books));
    }

    public function view($id, TextTagService $tagService)
    {
        $text = Text::find($id);
        $tagged = $tagService::tagText($text->text_content);
        $text->text_content = $tagged['text'];
        $text->total_words = $tagged['total_words'];
        $text->known_words = $tagged['known_words'];
        return response()->json($text);
    }

    public function process(TextTagService $tagService)
    {
        $text = 'Los huracanes son las tormentas más grandes y violentas del planeta.
Cada año, entre los meses de junio y noviembre, azotan la zona del Caribe, el Golfo de México y la costa este de Estados Unidos, en algunas ocasiones arrasando con edificios y poblaciones.
Sus homólogos son los tifones, que afectan al noroeste del océano Pacífico, y los ciclones, que lo hacen al sur del Pacífico y el océano Índico.

Todos son ciclones tropicales, pero el nombre "huracán" se usa exclusivamente para los del Atlántico norte y del noreste del Pacífico.
Pero, ¿cómo se forman y por qué suelen afectar a esta zona del mundo?
Huracanes, bombas de energía
El mecanismo más común de formación de huracanes en el Atlántico — que provoca más del 60% de estos fenómenos — es una onda tropical.
La onda empieza como una perturbación atmosférica que crea un área de relativa baja presión.
Suele generarse en África Oriental a partir de mediados de julio.
Si encuentra las condiciones adecuadas para mantenerse o desarrollarse, este área de baja presión empieza a moverse de este a oeste, con la ayuda de los vientos alisios.

Cuando llega al océano Atlántico, la onda tropical puede ser el germen de un huracán, pero para que este se forme necesita fuentes de energía, como el calor y el viento adecuado.
En concreto, es necesario que la superficie del agua esté por encima de los 27ºC y que haya una capa espesa de agua caliente en el océano.

También tiene que haber, por un lado, vientos con un giro horizontal para que la tormenta se concentre. Por el otro, vientos que mantengan su fuerza y velocidad constante a medida que suben desde la superficie del océano.
Si hay cortante de viento, o variaciones del viento con la altura, esto puede interrumpir el flujo de calor y humedad que hace que el huracán se forme.
Además, tiene que haber una concentración de nubes cargadas de agua y una humedad relativa alta presente en la atmósfera.

Todo esto tiene que ocurrir en las latitudes adecuadas, en general entre los paralelos 10° y 30° del hemisferio norte, ya que aquí el efecto de la rotación de la Tierra hace que los vientos puedan converger y ascender alrededor del área de baja presión.
Cuando la onda tropical encuentra todos estos ingredientes, se crea un área de unos 50-100 km, donde empiezan a interactuar.
"El movimiento de la onda tropical funciona como el disparador de esa tormenta", explica a BBC Mundo Jorge Zavala Hidalgo, coordinador general del Servicio Meteorológico Nacional de México.

Y es esta tormenta la que hace de catalizador: empieza el baile de calor, aire y agua.
El área de baja presión hace que el aire húmedo y caliente que viene del océano suba y se enfríe, lo que alimenta las nubes.
La condensación de este aire libera calor y provoca que la presión sobre la superficie del océano baje aún más, lo que atrae más humedad del océano, engrosando la tormenta.
Los vientos convergen y ascienden dentro de este área de baja presión, girando en dirección contraria a las agujas del reloj — por influencia de la rotación de la Tierra — y dando a los huracanes esa imagen tan característica.

A medida que la tormenta se hace más poderosa, el ojo del huracán — el área central de hasta 10km — permanece relativamente tranquilo.
A su alrededor se levanta la pared del ojo, compuesta de nubes densas donde se localizan los vientos más intensos.
Más allá, están las bandas nubosas en forma de espiral, donde hay más lluvias.
La velocidad de los vientos es la que determina en qué momento podemos llamar a este fenómeno "huracán": en su nacimiento es una depresión tropical, cuando aumenta de fuerza pasa a ser una tormenta tropical y se convierte en huracán cuando pasa de los 118 km por hora.

A partir de ahí, se suelen clasificar en cinco categorías según la velocidad sostenida del viento. En el Atlántico, se usa la escala de vientos Saffir-Simpson para medir su poder destructivo.
Tal es su fuerza que los vientos de un huracán podrían producir la misma energía que casi la mitad de la capacidad de generación eléctrica del mundo entero, según la Administración Nacional de Océanos y de la Atmósfera de Estados Unidos (NOOA, por sus siglas en inglés).

Sin embargo, no es el viento sino la marejada y las inundaciones que provoca la lluvia que descarga el huracán las que generalmente causan la mayor destrucción y pérdida de vidas.
En Estados Unidos, por ejemplo, la marejada provocada por ciclones tropicales en el Atlántico fue responsable de casi la mitad de muertes entre 1963 y 2012, según datos de la Sociedad Americana de Meteorología (AMS, por sus siglas en inglés).
Además de estos factores, la destrucción causada por un huracán va a depender de otras circunstancias, como la velocidad a la que pasa, la geografía del territorio y la infraestructura de la zona afectada.

"No necesariamente el daño o el peligro asociado a un ciclón tropical corresponde a su categoría. Por ejemplo, el ciclón de mayor categoría no tiene porque tener asociada más precipitación", dice Jorge Zavala Hidalgo a BBC Mundo.
México, Estados Unidos y el Caribe: las zonas más vulnerables
Uno de los factores que explica que esta parte del mundo sea propensa a los huracanes es que el océano Atlántico, en las latitudes tropicales, tiene la temperatura adecuada para su formación durante más meses al año.
Otro es el movimiento de las grandes corrientes de vientos que empujan los huracanes.
Los vientos alisios — las corrientes de vientos globales en el trópico — van de este a oeste llevándolos hacia las costas del Caribe, el Golfo de México y el sur de Estados Unidos.
El recorrido de estos vientos también está influenciado por la rotación de la Tierra — el llamado efecto Coriolis — que hace que tiendan a desviarse hacia el norte.

Los huracanes que se formaron en el Atlántico norte durante el 2019 siguieron distintos recorridos según las corrientes globales de viento u otros fenómenos - como los anticiclones - que encontraban en su camino.
En el Atlántico, mientras los huracanes avanzan se desvían levemente hacia el norte; y al superar aproximadamente los 30°N, suelen encontrase con los vientos del oeste, otra de las grandes corrientes globales, que hacen que se curven hacia el este.
En su camino van toparse con el anticiclón de Bermudas-Azores que va a determinar si se dirigen hacia el Golfo de México o hacia Estados Unidos.
Los anticiclones son regiones de alta presión atmosférica con aire más seco, menos nubes y vientos que giran en la dirección de las agujas del reloj en el hemisferio norte.
El anticiclón de Bermudas actúa como un obstáculo y si los huracanes quieren avanzar tienen que bordearlo. Por este motivo, el tamaño y la posición del anticiclón puede determinar hacia dónde va un ciclón tropical.

Si es débil y está más posicionado hacia el este, los huracanes lo rodean y siguen hacia el norte, alejándose del Caribe.
Por lo contrario, si es más fuerte y se encuentra al suroeste, un ciclón tropical puede dirigirse hacia el Golfo de México o hacia Florida.
La posición del anticiclón cambia según el año, las estaciones y puede variar en cuestión de días.
"A causa de esas variaciones, un huracán puede seguir una trayectoria muy distinta hoy que otro que pasa tres o cinco días después", explica Jorge Zavala Hidalgo, del Servicio Meteorológico Nacional de México.
Siguiendo la misma lógica, los anticiclones y otras masas de aire son responsables de que un huracán se recurve hacia el oeste, como pasó en 2012 con el huracán Sandy, por ejemplo.
En su camino hacia el norte, el huracán Sandy (2012) se curvó azotando las costas de Nueva York y Nueva Inglaterra, en Estados Unidos.
Después de tocar tierra en Cuba, Sandy empezó a desplazarse hacia el noreste, pero un anticiclón en Groenlandia y un frente frío bloquearon su camino. Eso provocó que Sandy retrocediera hacia la costa este de Estados Unidos, causando destrucción en Nueva York y Nueva Jersey.
El Pacífico Este a pesar de que es una zona más activa que el Atlántico Norte, allí tocan tierra menos huracanes.
"Lo que sucede es que esas tormentas suelen dirigirse hacia el oeste o noroeste. Algunas pueden retroceder hacia las costas de México si los vientos son los adecuados, pero la mayoría se dirigen a latitudes más altas, encuentran aguas más frías y desaparecen", dice a BBC Mundo Gary M. Barnes, profesor retirado de la Universidad de Hawái, Estados Unidos.
Por qué casi no vemos en Sudamérica
Si bien la parte norte del Atlántico puede ofrecer las condiciones ideales para la formación de huracanes, no ocurre lo mismo bajo la línea del Ecuador.
"El Atlántico Sur es más tranquilo porque no hay onda tropical — es un fenómeno más común en el hemisferio norte — y hay más variaciones en la velocidad y en la dirección del viento, algo que inhibe la formación de huracanes", explica Barnes.

Además, los ciclones tropicales normalmente no se forman si no están al menos a unos 500 kilómetros del Ecuador, ya que el efecto Coriolis es demasiado débil para hacer que los vientos giren y formen un huracán.

Aunque es un fenómeno que pasa con poquísima frecuencia en Sudamérica, sí se han registrado huracanes en las costas del sur de Brasil.
En 2004, el ciclón tropical Catarina dejó 11 muertos y más de 30.000 personas desplazadas.

¿Y cómo puede impactar el cambio climático?
"El cambio climático provoca que la temperatura de la superficie del océano y la capa gruesa sean más calientes y eso es un problema. Tenemos teorías que dicen que si el océano es más cálido eso puede traducirse en tormentas más fuertes e intensas.", dice el meteorólogo Gary M. Barnes.
Hay indicaciones de que las áreas en que un ciclón encuentra condiciones para mantenerse y sobrevivir se están extendiendo con el paso del tiempo, según Jorge Hidalgo, coordinador del Servicio Meteorológico Nacional de México.

"Quizás el número de ciclones no aumente pero la distribución de categorías puede cambiar. Es decir, que haya más huracanes de categoría mayor y menos de categoría menor", añade Zavala.
Los científicos coinciden, sin embargo, que es muy pronto para medir el impacto del cambio climático en la formación y avance de los huracanes.
"Es probable que las tormentas se intensifiquen muy poco a poco, pero vamos a necesitar muchísima data para probar que el calentamiento global va a provocar huracanes más fuertes. En 25 años puede que tengamos evidencias", concluye Barnes.';

        $uniqueWords = $tagService::getUniqueWords($text);
        $date = new \DateTime('now');
        $iso = $date->format(\DateTime::ATOM);

        $text = new Text([
            'text_title' => 'Huracán Laura: cómo se forman los ciclones tropicales y por qué son tan frecuentes en México, Estados Unidos y el Caribe',
            'text_content' => $text,
            'publication_date' => '2020-08-26 10:00:00',
            'site_name' => 'BBC Mundo',
            'direct_link' => 'https://www.bbc.com/mundo/noticias-internacional-53910147',
            'lang' => 'Spanish',
            'blurb' => substr($text, 0, 255),
            'total_words' => count($uniqueWords)
        ]);
        $text->save();
        $id = $text->getKey();

        foreach($uniqueWords as $uniqueWord)
        {
            Word::firstOrCreate([
                'word' => $uniqueWord,
                'lang' => 'Spanish'
            ]);

            DB::table('word_text')->insert(
                ['word' => $uniqueWord, 'text_id' => $id]
            );

        }



    }
}
