<?php

namespace MateuszBieniek\EzPlatformFormBuilderMaskedInput\Form\Type;

use EzSystems\EzPlatformFormBuilder\Form\Type\Field\AbstractFieldType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class MaskedFieldType extends AbstractFieldType
{
    private $twig;
    private $dispatcher;

    public function __construct(\Twig_Environment $twig, EventDispatcherInterface $dispatcher)
    {
        $this->twig = $twig;
        $this->dispatcher = $dispatcher;
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $javascriptContent = $this->twig->render('EzPlatformFormBuilderMaskedInputBundle:form:js.html.twig', []);

        $this->dispatcher->addListener('kernel.response', function ($event) use ($javascriptContent) {
            $response = $event->getResponse();
            $content = $response->getContent();
            if (strpos($content, 'ezplatform-form-builder-mb-masked-input.js') !== false) {
                return;
            }

            $pos = strripos($content, '</body>');
            if ($pos !== false) {
                $content = substr($content, 0, $pos) . $javascriptContent . substr($content, $pos);
                $response->setContent($content);
                $event->setResponse($response);
            }
        });
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix()
    {
        return 'mateuszbieniek_masked_input';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return TextType::class;
    }
}
