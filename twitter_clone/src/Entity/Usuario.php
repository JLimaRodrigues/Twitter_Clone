<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\Table(name: 'usuarios')]
class Usuario extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $id_usuario = null;

    #[ORM\Column(length: 255)]
    protected ?string $email = null;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTimeImmutable $dataNasc = null;

    #[ORM\Column(length: 20, nullable: true)]
    protected ?string $telefone = null;

    #[ORM\Column(length: 200, nullable: true)]
    protected ?string $foto = null;

    #[ORM\Column(length: 200)]
    protected ?string $usuario = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected ?\DateTimeImmutable $criado_em = null;

}
