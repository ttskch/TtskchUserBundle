<?php

declare(strict_types=1);

namespace Ttskch\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @UniqueEntity(fields={"username"})
 * @UniqueEntity(fields={"email"})
 */
abstract class User implements UserInterface, EquatableInterface, \Serializable
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="array")
     *
     * @var array|string[]
     */
    protected $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $password;

    /**
     * @var string|null
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $enabled = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    protected $lastLoggedInAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    protected $confirmationToken;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    protected $emailUpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    protected $passwordResettingRequestedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    protected $salt;

    /**
     * @see UserInterface
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return (string) $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getEnabled(): bool
    {
        return (bool) $this->enabled;
    }

    public function setEnabled(bool $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getLastLoggedInAt(): ?\DateTimeInterface
    {
        return $this->lastLoggedInAt;
    }

    public function setLastLoggedInAt(\DateTimeInterface $lastLoggedInAt): self
    {
        $this->lastLoggedInAt = $lastLoggedInAt;

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return (string) $this->confirmationToken;
    }

    public function setConfirmationToken(string $confimationToken): self
    {
        $this->confirmationToken = $confimationToken;

        return $this;
    }

    public function getEmailUpdatedAt(): ?\DateTimeInterface
    {
        return $this->emailUpdatedAt;
    }

    public function setEmailUpdatedAt(\DateTimeInterface $emailUpdatedAt): self
    {
        $this->emailUpdatedAt = $emailUpdatedAt;

        return $this;
    }

    public function getPasswordResettingRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordResettingRequestedAt;
    }

    public function setPasswordResettingRequestedAt(\DateTimeInterface $passwordResettingRequestedAt): self
    {
        $this->passwordResettingRequestedAt = $passwordResettingRequestedAt;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return (string) $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    /**
     * @see EquatableInterface
     */
    public function isEqualTo(UserInterface $user): bool
    {
        return $user instanceof static && $user->getUsername() === $this->username && $user->getPassword() === $this->password && $user->getSalt() === $this->salt;
    }

    /**
     * @see \Serializable
     * @see https://symfony.com/doc/3.4/security/entity_provider.html
     */
    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            $this->enabled,
            $this->salt,
        ]);
    }

    /**
     * @see \Serializable
     *
     * {@inheritDoc}
     */
    public function unserialize($serialized): void
    {
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            $this->enabled,
            $this->salt
        ) = unserialize($serialized);
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
