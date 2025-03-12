<?php

namespace App\Entity;

use App\Repository\AmizadeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmizadeRepository::class)]
#[ORM\Table(name: 'amizades')]
class Amizade extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id_amizade = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'id_usuario')]
    protected ?Usuario $requester = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'id_usuario')]
    protected ?Usuario $requested = null;

    #[ORM\Column(type: Types::STRING, enumType: AmizadeStatus::class)]
    protected ?AmizadeStatus $status = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected ?\DateTimeImmutable $criado_em = null;

    public function __construct()
    {
        $this->criado_em = new \DateTimeImmutable();
        $this->status = AmizadeStatus::PENDENTE;
    }
    
}

enum AmizadeStatus: string
{
    case PENDENTE = 'pendente';
    case ACEITO = 'aceito';
    case REJEITADO = 'rejeitado';
}
