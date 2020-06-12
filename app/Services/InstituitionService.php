<?php 

namespace App\Services;

use App\Repositories\InstituitionRepository;
use App\Validators\InstituitionValidator;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Prettus\Validator\Contracts\ValidatorInterface;

class InstituitionService{

    private $repository;
    private $validator;

    public function __construct(InstituitionRepository $repository, InstituitionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store(array $data){

        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $instituition = $this->repository->create($data);
            return[
                'success' => true,
                'messages' => 'Instituição Cadastrada',
                'data' => $instituition,
            ];
        }catch(Exception $e){

            switch(get_class($e)){

                case QueryException::class  : return ['success' => false, 'messages' => $e->getMessage()];
                //case ValidatorException::class : return ['success' => false, 'messages' => $e->getMessageBag()];
                case Exception::class : return ['success' => false, 'messages' => $e->getMessage()];
                default          : return ['success' => false, 'messages' => $e->getMessage()];
            }
        }
    }

    public function update(array $data, $id){

        try{
            $this->validator->with($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $instituition = $this->repository->update($data,$id);

            return [
                'success' => true,
                'messages' => "Instituição atualizada",
                'data' => $instituition,
            ];

        }catch(Exception $e)
        {
            switch(get_class($e)){
                case QueryException::class  : return ['success' => false, 'messages' => $e->getMessage()];
                //case ValidatorException::class : return ['success' => false, 'messages' => $e->getMessageBag()];
                case Exception::class : return ['success' => false, 'messages' => $e->getMessage()];
                default          : return ['success' => false, 'messages' => $e->getMessage()];
            }
        }
    }
}